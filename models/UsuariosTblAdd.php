<?php

namespace PHPMaker2023\ieproes;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class UsuariosTblAdd extends UsuariosTbl
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "UsuariosTblAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "UsuariosTblAdd";

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page layout
    public $UseLayout = true;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl($withArgs = true)
    {
        $route = GetRoute();
        $args = RemoveXss($route->getArguments());
        if (!$withArgs) {
            foreach ($args as $key => &$val) {
                $val = "";
            }
            unset($val);
        }
        return rtrim(UrlFor($route->getName(), $args), "/") . "?";
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<p id="ew-page-header">' . $header . '</p>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<p id="ew-page-footer">' . $footer . '</p>';
        }
    }

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer, $UserTable;
        $this->TableVar = 'usuarios_tbl';
        $this->TableName = 'usuarios_tbl';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-add-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Table object (usuarios_tbl)
        if (!isset($GLOBALS["usuarios_tbl"]) || get_class($GLOBALS["usuarios_tbl"]) == PROJECT_NAMESPACE . "usuarios_tbl") {
            $GLOBALS["usuarios_tbl"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'usuarios_tbl');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] ??= $this->getConnection();

        // User table object
        $UserTable = Container("usertable");
    }

    // Get content from stream
    public function getContents(): string
    {
        global $Response;
        return is_object($Response) ? $Response->getBody() : ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

        // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }

        // Global Page Unloaded event (in userfn*.php)
        Page_Unloaded();
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show response for API
                $ar = array_merge($this->getMessages(), $url ? ["url" => GetUrl($url)] : []);
                WriteJson($ar);
            }
            $this->clearMessages(); // Clear messages for API request
            return;
        } else { // Check if response is JSON
            if (StartsString("application/json", $Response->getHeaderLine("Content-type")) && $Response->getBody()->getSize()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response (Assume return to modal for simplicity)
            if ($this->IsModal) { // Show as modal
                $result = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page => View page
                    $result["caption"] = $this->getModalCaption($pageName);
                    $result["view"] = $pageName == "UsuariosTblView"; // If View page, no primary button
                } else { // List page
                    // $result["list"] = $this->PageID == "search"; // Refresh List page if current page is Search page
                    $result["error"] = $this->getFailureMessage(); // List page should not be shown as modal => error
                    $this->clearFailureMessage();
                }
                WriteJson($result);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from recordset
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Recordset
            while ($rs && !$rs->EOF) {
                $this->loadRowValues($rs); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($rs->fields);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
                $rs->moveNext();
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DATATYPE_BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['id_usuario'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->id_usuario->Visible = false;
        }
    }

    // Lookup data
    public function lookup($ar = null)
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = $ar["field"] ?? Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;
        $name = $ar["name"] ?? Post("name");
        $isQuery = ContainsString($name, "query_builder_rule");
        if ($isQuery) {
            $lookup->FilterFields = []; // Skip parent fields if any
        }

        // Get lookup parameters
        $lookupType = $ar["ajax"] ?? Post("ajax", "unknown");
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal") || SameText($lookupType, "filter")) {
            $searchValue = $ar["q"] ?? Param("q") ?? $ar["sv"] ?? Post("sv", "");
            $pageSize = $ar["n"] ?? Param("n") ?? $ar["recperpage"] ?? Post("recperpage", 10);
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = $ar["q"] ?? Param("q", "");
            $pageSize = $ar["n"] ?? Param("n", -1);
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
        }
        $start = $ar["start"] ?? Param("start", -1);
        $start = is_numeric($start) ? (int)$start : -1;
        $page = $ar["page"] ?? Param("page", -1);
        $page = is_numeric($page) ? (int)$page : -1;
        $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        $userSelect = Decrypt($ar["s"] ?? Post("s", ""));
        $userFilter = Decrypt($ar["f"] ?? Post("f", ""));
        $userOrderBy = Decrypt($ar["o"] ?? Post("o", ""));
        $keys = $ar["keys"] ?? Post("keys");
        $lookup->LookupType = $lookupType; // Lookup type
        $lookup->FilterValues = []; // Clear filter values first
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = $ar["v0"] ?? $ar["lookupValue"] ?? Post("v0", Post("lookupValue", ""));
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = $ar["v" . $i] ?? Post("v" . $i, "");
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        return $lookup->toJson($this, !is_array($ar)); // Use settings from current page
    }
    public $FormClassName = "ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $CopyRecord;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $UserProfile, $Language, $Security, $CurrentForm, $SkipHeaderFooter;

        // Is modal
        $this->IsModal = ConvertToBool(Param("modal"));
        $this->UseLayout = $this->UseLayout && !$this->IsModal;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param(Config("PAGE_LAYOUT"), true));

        // View
        $this->View = Get(Config("VIEW"));

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->id_usuario->Visible = false;
        $this->tipo_usuario->setVisibility();
        $this->nombre_usuario->setVisibility();
        $this->login_usuario->setVisibility();
        $this->password_usuario->setVisibility();
        $this->email_usuario->setVisibility();
        $this->parent_id_usuario->setVisibility();

        // Set lookup cache
        if (!in_array($this->PageID, Config("LOOKUP_CACHE_PAGE_IDS"))) {
            $this->setUseLookupCache(false);
        }

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Hide fields for add/edit
        if (!$this->UseAjaxActions) {
            $this->hideFieldsForAddEdit();
        }
        // Use inline delete
        if ($this->UseAjaxActions) {
            $this->InlineDelete = true;
        }

        // Set up lookup cache
        $this->setupLookupOptions($this->tipo_usuario);

        // Load default values for add
        $this->loadDefaultValues();

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action", "") !== "") {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("id_usuario") ?? Route("id_usuario")) !== null) {
                $this->id_usuario->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record or default values
        $rsold = $this->loadOldRecord();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$rsold) { // Record not loaded
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("UsuariosTblList"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($rsold)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "UsuariosTblList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "UsuariosTblView") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }

                    // Handle UseAjaxActions
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "UsuariosTblList") {
                            Container("flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "UsuariosTblList"; // Return list page content
                        }
                    }
                    if (IsJsonResponse()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } elseif ($this->IsModal && $this->UseAjaxActions) { // Return JSON error message
                    WriteJson([ "success" => false, "error" => $this->getFailureMessage() ]);
                    $this->clearFailureMessage();
                    $this->terminate();
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = ROWTYPE_ADD; // Render add type

        // Render row
        $this->resetAttributes();
        $this->renderRow();

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Setup login status
            SetupLoginStatus();

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }

            // Render search option
            if (method_exists($this, "renderSearchOptions")) {
                $this->renderSearchOptions();
            }
        }
    }

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load default values
    protected function loadDefaultValues()
    {
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'tipo_usuario' first before field var 'x_tipo_usuario'
        $val = $CurrentForm->hasValue("tipo_usuario") ? $CurrentForm->getValue("tipo_usuario") : $CurrentForm->getValue("x_tipo_usuario");
        if (!$this->tipo_usuario->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tipo_usuario->Visible = false; // Disable update for API request
            } else {
                $this->tipo_usuario->setFormValue($val);
            }
        }

        // Check field name 'nombre_usuario' first before field var 'x_nombre_usuario'
        $val = $CurrentForm->hasValue("nombre_usuario") ? $CurrentForm->getValue("nombre_usuario") : $CurrentForm->getValue("x_nombre_usuario");
        if (!$this->nombre_usuario->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nombre_usuario->Visible = false; // Disable update for API request
            } else {
                $this->nombre_usuario->setFormValue($val);
            }
        }

        // Check field name 'login_usuario' first before field var 'x_login_usuario'
        $val = $CurrentForm->hasValue("login_usuario") ? $CurrentForm->getValue("login_usuario") : $CurrentForm->getValue("x_login_usuario");
        if (!$this->login_usuario->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->login_usuario->Visible = false; // Disable update for API request
            } else {
                $this->login_usuario->setFormValue($val);
            }
        }

        // Check field name 'password_usuario' first before field var 'x_password_usuario'
        $val = $CurrentForm->hasValue("password_usuario") ? $CurrentForm->getValue("password_usuario") : $CurrentForm->getValue("x_password_usuario");
        if (!$this->password_usuario->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->password_usuario->Visible = false; // Disable update for API request
            } else {
                $this->password_usuario->setFormValue($val);
            }
        }

        // Check field name 'email_usuario' first before field var 'x_email_usuario'
        $val = $CurrentForm->hasValue("email_usuario") ? $CurrentForm->getValue("email_usuario") : $CurrentForm->getValue("x_email_usuario");
        if (!$this->email_usuario->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->email_usuario->Visible = false; // Disable update for API request
            } else {
                $this->email_usuario->setFormValue($val);
            }
        }

        // Check field name 'parent_id_usuario' first before field var 'x_parent_id_usuario'
        $val = $CurrentForm->hasValue("parent_id_usuario") ? $CurrentForm->getValue("parent_id_usuario") : $CurrentForm->getValue("x_parent_id_usuario");
        if (!$this->parent_id_usuario->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->parent_id_usuario->Visible = false; // Disable update for API request
            } else {
                $this->parent_id_usuario->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'id_usuario' first before field var 'x_id_usuario'
        $val = $CurrentForm->hasValue("id_usuario") ? $CurrentForm->getValue("id_usuario") : $CurrentForm->getValue("x_id_usuario");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->tipo_usuario->CurrentValue = $this->tipo_usuario->FormValue;
        $this->nombre_usuario->CurrentValue = $this->nombre_usuario->FormValue;
        $this->login_usuario->CurrentValue = $this->login_usuario->FormValue;
        $this->password_usuario->CurrentValue = $this->password_usuario->FormValue;
        $this->email_usuario->CurrentValue = $this->email_usuario->FormValue;
        $this->parent_id_usuario->CurrentValue = $this->parent_id_usuario->FormValue;
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssociative($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }

        // Check if valid User ID
        if ($res) {
            $res = $this->showOptionLink("add");
            if (!$res) {
                $userIdMsg = DeniedMessage();
                $this->setFailureMessage($userIdMsg);
            }
        }
        return $res;
    }

    /**
     * Load row values from recordset or record
     *
     * @param Recordset|array $rs Record
     * @return void
     */
    public function loadRowValues($rs = null)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            $row = $this->newRow();
        }
        if (!$row) {
            return;
        }

        // Call Row Selected event
        $this->rowSelected($row);
        $this->id_usuario->setDbValue($row['id_usuario']);
        $this->tipo_usuario->setDbValue($row['tipo_usuario']);
        $this->nombre_usuario->setDbValue($row['nombre_usuario']);
        $this->login_usuario->setDbValue($row['login_usuario']);
        $this->password_usuario->setDbValue($row['password_usuario']);
        $this->email_usuario->setDbValue($row['email_usuario']);
        $this->parent_id_usuario->setDbValue($row['parent_id_usuario']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id_usuario'] = $this->id_usuario->DefaultValue;
        $row['tipo_usuario'] = $this->tipo_usuario->DefaultValue;
        $row['nombre_usuario'] = $this->nombre_usuario->DefaultValue;
        $row['login_usuario'] = $this->login_usuario->DefaultValue;
        $row['password_usuario'] = $this->password_usuario->DefaultValue;
        $row['email_usuario'] = $this->email_usuario->DefaultValue;
        $row['parent_id_usuario'] = $this->parent_id_usuario->DefaultValue;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        if ($this->OldKey != "") {
            $this->setKey($this->OldKey);
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $rs = LoadRecordset($sql, $conn);
            if ($rs && ($row = $rs->fields)) {
                $this->loadRowValues($row); // Load row values
                return $row;
            }
        }
        $this->loadRowValues(); // Load default row values
        return null;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id_usuario
        $this->id_usuario->RowCssClass = "row";

        // tipo_usuario
        $this->tipo_usuario->RowCssClass = "row";

        // nombre_usuario
        $this->nombre_usuario->RowCssClass = "row";

        // login_usuario
        $this->login_usuario->RowCssClass = "row";

        // password_usuario
        $this->password_usuario->RowCssClass = "row";

        // email_usuario
        $this->email_usuario->RowCssClass = "row";

        // parent_id_usuario
        $this->parent_id_usuario->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id_usuario
            $this->id_usuario->ViewValue = $this->id_usuario->CurrentValue;

            // tipo_usuario
            if ($Security->canAdmin()) { // System admin
                $curVal = strval($this->tipo_usuario->CurrentValue);
                if ($curVal != "") {
                    $this->tipo_usuario->ViewValue = $this->tipo_usuario->lookupCacheOption($curVal);
                    if ($this->tipo_usuario->ViewValue === null) { // Lookup from database
                        $filterWrk = SearchFilter("`UserLevelID`", "=", $curVal, DATATYPE_NUMBER, "");
                        $lookupFilter = $this->tipo_usuario->getSelectFilter($this); // PHP
                        $sqlWrk = $this->tipo_usuario->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                        $conn = Conn();
                        $config = $conn->getConfiguration();
                        $config->setResultCacheImpl($this->Cache);
                        $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                        $ari = count($rswrk);
                        if ($ari > 0) { // Lookup values found
                            $arwrk = $this->tipo_usuario->Lookup->renderViewRow($rswrk[0]);
                            $this->tipo_usuario->ViewValue = $this->tipo_usuario->displayValue($arwrk);
                        } else {
                            $this->tipo_usuario->ViewValue = FormatNumber($this->tipo_usuario->CurrentValue, $this->tipo_usuario->formatPattern());
                        }
                    }
                } else {
                    $this->tipo_usuario->ViewValue = null;
                }
            } else {
                $this->tipo_usuario->ViewValue = $Language->phrase("PasswordMask");
            }

            // nombre_usuario
            $this->nombre_usuario->ViewValue = $this->nombre_usuario->CurrentValue;

            // login_usuario
            $this->login_usuario->ViewValue = $this->login_usuario->CurrentValue;

            // password_usuario
            $this->password_usuario->ViewValue = $Language->phrase("PasswordMask");

            // email_usuario
            $this->email_usuario->ViewValue = $this->email_usuario->CurrentValue;

            // parent_id_usuario
            $this->parent_id_usuario->ViewValue = $this->parent_id_usuario->CurrentValue;
            $this->parent_id_usuario->ViewValue = FormatNumber($this->parent_id_usuario->ViewValue, $this->parent_id_usuario->formatPattern());

            // tipo_usuario
            $this->tipo_usuario->HrefValue = "";

            // nombre_usuario
            $this->nombre_usuario->HrefValue = "";

            // login_usuario
            $this->login_usuario->HrefValue = "";

            // password_usuario
            $this->password_usuario->HrefValue = "";

            // email_usuario
            $this->email_usuario->HrefValue = "";

            // parent_id_usuario
            $this->parent_id_usuario->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // tipo_usuario
            $this->tipo_usuario->setupEditAttributes();
            if (!$Security->canAdmin()) { // System admin
                $this->tipo_usuario->EditValue = $Language->phrase("PasswordMask");
            } else {
                $curVal = trim(strval($this->tipo_usuario->CurrentValue));
                if ($curVal != "") {
                    $this->tipo_usuario->ViewValue = $this->tipo_usuario->lookupCacheOption($curVal);
                } else {
                    $this->tipo_usuario->ViewValue = $this->tipo_usuario->Lookup !== null && is_array($this->tipo_usuario->lookupOptions()) ? $curVal : null;
                }
                if ($this->tipo_usuario->ViewValue !== null) { // Load from cache
                    $this->tipo_usuario->EditValue = array_values($this->tipo_usuario->lookupOptions());
                } else { // Lookup from database
                    if ($curVal == "") {
                        $filterWrk = "0=1";
                    } else {
                        $filterWrk = SearchFilter("`UserLevelID`", "=", $this->tipo_usuario->CurrentValue, DATATYPE_NUMBER, "");
                    }
                    $lookupFilter = $this->tipo_usuario->getSelectFilter($this); // PHP
                    $sqlWrk = $this->tipo_usuario->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    $arwrk = $rswrk;
                    $this->tipo_usuario->EditValue = $arwrk;
                }
                $this->tipo_usuario->PlaceHolder = RemoveHtml($this->tipo_usuario->caption());
            }

            // nombre_usuario
            $this->nombre_usuario->setupEditAttributes();
            if (!$this->nombre_usuario->Raw) {
                $this->nombre_usuario->CurrentValue = HtmlDecode($this->nombre_usuario->CurrentValue);
            }
            $this->nombre_usuario->EditValue = HtmlEncode($this->nombre_usuario->CurrentValue);
            $this->nombre_usuario->PlaceHolder = RemoveHtml($this->nombre_usuario->caption());

            // login_usuario
            $this->login_usuario->setupEditAttributes();
            if (!$this->login_usuario->Raw) {
                $this->login_usuario->CurrentValue = HtmlDecode($this->login_usuario->CurrentValue);
            }
            $this->login_usuario->EditValue = HtmlEncode($this->login_usuario->CurrentValue);
            $this->login_usuario->PlaceHolder = RemoveHtml($this->login_usuario->caption());

            // password_usuario
            $this->password_usuario->setupEditAttributes();
            $this->password_usuario->PlaceHolder = RemoveHtml($this->password_usuario->caption());

            // email_usuario
            $this->email_usuario->setupEditAttributes();
            if (!$this->email_usuario->Raw) {
                $this->email_usuario->CurrentValue = HtmlDecode($this->email_usuario->CurrentValue);
            }
            $this->email_usuario->EditValue = HtmlEncode($this->email_usuario->CurrentValue);
            $this->email_usuario->PlaceHolder = RemoveHtml($this->email_usuario->caption());

            // parent_id_usuario
            $this->parent_id_usuario->setupEditAttributes();
            if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin
            } else {
                $this->parent_id_usuario->EditValue = HtmlEncode($this->parent_id_usuario->CurrentValue);
                $this->parent_id_usuario->PlaceHolder = RemoveHtml($this->parent_id_usuario->caption());
                if (strval($this->parent_id_usuario->EditValue) != "" && is_numeric($this->parent_id_usuario->EditValue)) {
                    $this->parent_id_usuario->EditValue = FormatNumber($this->parent_id_usuario->EditValue, null);
                }
            }

            // Add refer script

            // tipo_usuario
            $this->tipo_usuario->HrefValue = "";

            // nombre_usuario
            $this->nombre_usuario->HrefValue = "";

            // login_usuario
            $this->login_usuario->HrefValue = "";

            // password_usuario
            $this->password_usuario->HrefValue = "";

            // email_usuario
            $this->email_usuario->HrefValue = "";

            // parent_id_usuario
            $this->parent_id_usuario->HrefValue = "";
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language, $Security;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        $validateForm = true;
        if ($this->tipo_usuario->Required) {
            if ($Security->canAdmin() && !$this->tipo_usuario->IsDetailKey && EmptyValue($this->tipo_usuario->FormValue)) {
                $this->tipo_usuario->addErrorMessage(str_replace("%s", $this->tipo_usuario->caption(), $this->tipo_usuario->RequiredErrorMessage));
            }
        }
        if ($this->nombre_usuario->Required) {
            if (!$this->nombre_usuario->IsDetailKey && EmptyValue($this->nombre_usuario->FormValue)) {
                $this->nombre_usuario->addErrorMessage(str_replace("%s", $this->nombre_usuario->caption(), $this->nombre_usuario->RequiredErrorMessage));
            }
        }
        if ($this->login_usuario->Required) {
            if (!$this->login_usuario->IsDetailKey && EmptyValue($this->login_usuario->FormValue)) {
                $this->login_usuario->addErrorMessage(str_replace("%s", $this->login_usuario->caption(), $this->login_usuario->RequiredErrorMessage));
            }
        }
        if (!$this->login_usuario->Raw && Config("REMOVE_XSS") && CheckUsername($this->login_usuario->FormValue)) {
            $this->login_usuario->addErrorMessage($Language->phrase("InvalidUsernameChars"));
        }
        if ($this->password_usuario->Required) {
            if (!$this->password_usuario->IsDetailKey && EmptyValue($this->password_usuario->FormValue)) {
                $this->password_usuario->addErrorMessage(str_replace("%s", $this->password_usuario->caption(), $this->password_usuario->RequiredErrorMessage));
            }
        }
        if (!$this->password_usuario->Raw && Config("REMOVE_XSS") && CheckPassword($this->password_usuario->FormValue)) {
            $this->password_usuario->addErrorMessage($Language->phrase("InvalidPasswordChars"));
        }
        if ($this->email_usuario->Required) {
            if (!$this->email_usuario->IsDetailKey && EmptyValue($this->email_usuario->FormValue)) {
                $this->email_usuario->addErrorMessage(str_replace("%s", $this->email_usuario->caption(), $this->email_usuario->RequiredErrorMessage));
            }
        }
        if ($this->parent_id_usuario->Required) {
            if (!$this->parent_id_usuario->IsDetailKey && EmptyValue($this->parent_id_usuario->FormValue)) {
                $this->parent_id_usuario->addErrorMessage(str_replace("%s", $this->parent_id_usuario->caption(), $this->parent_id_usuario->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->parent_id_usuario->FormValue)) {
            $this->parent_id_usuario->addErrorMessage($this->parent_id_usuario->getErrorMessage(false));
        }

        // Return validate result
        $validateForm = $validateForm && !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;

        // Set new row
        $rsnew = [];

        // tipo_usuario
        if ($Security->canAdmin()) { // System admin
            $this->tipo_usuario->setDbValueDef($rsnew, $this->tipo_usuario->CurrentValue, 0, false);
        }

        // nombre_usuario
        $this->nombre_usuario->setDbValueDef($rsnew, $this->nombre_usuario->CurrentValue, "", false);

        // login_usuario
        $this->login_usuario->setDbValueDef($rsnew, $this->login_usuario->CurrentValue, "", false);

        // password_usuario
        if (!IsMaskedPassword($this->password_usuario->CurrentValue)) {
            $this->password_usuario->setDbValueDef($rsnew, $this->password_usuario->CurrentValue, "", false);
        }

        // email_usuario
        $this->email_usuario->setDbValueDef($rsnew, $this->email_usuario->CurrentValue, null, false);

        // parent_id_usuario
        $this->parent_id_usuario->setDbValueDef($rsnew, $this->parent_id_usuario->CurrentValue, 0, false);

        // id_usuario

        // Update current values
        $this->setCurrentValues($rsnew);

        // Check if valid User ID
        if (
            !EmptyValue($Security->currentUserID()) &&
            !$Security->isAdmin() && // Non system admin
            !$Security->isValidUserID($this->id_usuario->CurrentValue)
        ) {
            $userIdMsg = str_replace("%c", CurrentUserID(), $Language->phrase("UnAuthorizedUserID"));
            $userIdMsg = str_replace("%u", strval($this->id_usuario->CurrentValue), $userIdMsg);
            $this->setFailureMessage($userIdMsg);
            return false;
        }

        // Check if valid Parent User ID
        if (
            !EmptyValue($Security->currentUserID()) &&
            !EmptyValue($this->parent_id_usuario->CurrentValue) && // Allow empty value
            !$Security->isAdmin() && // Non system admin
            !$Security->isValidUserID($this->parent_id_usuario->CurrentValue)
        ) {
            $parentUserIdMsg = str_replace("%c", CurrentUserID(), $Language->phrase("UnAuthorizedParentUserID"));
            $parentUserIdMsg = str_replace("%p", strval($this->parent_id_usuario->CurrentValue), $parentUserIdMsg);
            $this->setFailureMessage($parentUserIdMsg);
            return false;
        }
        $conn = $this->getConnection();

        // Load db values from old row
        $this->loadDbValues($rsold);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        if ($insertRow) {
            $addRow = $this->insert($rsnew);
            if ($addRow) {
            } elseif (!EmptyValue($this->DbErrorMessage)) { // Show database error
                $this->setFailureMessage($this->DbErrorMessage);
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("InsertCancelled"));
            }
            $addRow = false;
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
        }

        // Write JSON response
        if (IsJsonResponse() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            $table = $this->TableVar;
            WriteJson(["success" => true, "action" => Config("API_ADD_ACTION"), $table => $row]);
        }
        return $addRow;
    }

    // Show link optionally based on User ID
    protected function showOptionLink($id = "")
    {
        global $Security;
        if ($Security->isLoggedIn() && !$Security->isAdmin() && !$this->userIDAllow($id)) {
            return $Security->isValidUserID($this->id_usuario->CurrentValue);
        }
        return true;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("UsuariosTblList"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup !== null && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                case "x_tipo_usuario":
                    $lookupFilter = $fld->getSelectFilter(); // PHP
                    break;
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if (!$fld->hasLookupOptions() && $fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0 && count($fld->Lookup->FilterFields) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll();
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row, Container($fld->Lookup->LinkTable));
                    $key = $row["lf"];
                    if (IsFloatType($fld->Type)) { // Handle float field
                        $key = (float)$key;
                    }
                    $ar[strval($key)] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == 'success') {
            //$msg = "your success message";
        } elseif ($type == 'failure') {
            //$msg = "your failure message";
        } elseif ($type == 'warning') {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Page Breaking event
    public function pageBreaking(&$break, &$content)
    {
        // Example:
        //$break = false; // Skip page break, or
        //$content = "<div style=\"break-after:page;\"></div>"; // Modify page break content
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in $customError
        return true;
    }
}
