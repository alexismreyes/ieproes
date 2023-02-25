<?php

namespace PHPMaker2023\ieproes;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class AlumnotblEdit extends Alumnotbl
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "AlumnotblEdit";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "AlumnotblEdit";

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
        $this->TableVar = 'alumnotbl';
        $this->TableName = 'alumnotbl';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-edit-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Table object (alumnotbl)
        if (!isset($GLOBALS["alumnotbl"]) || get_class($GLOBALS["alumnotbl"]) == PROJECT_NAMESPACE . "alumnotbl") {
            $GLOBALS["alumnotbl"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'alumnotbl');
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
                    $result["view"] = $pageName == "AlumnotblView"; // If View page, no primary button
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
            $key .= @$ar['id_alumno'];
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
            $this->id_alumno->Visible = false;
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

    // Properties
    public $FormClassName = "ew-form ew-edit-form overlay-wrapper";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $HashValue; // Hash Value
    public $DisplayRecords = 1;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecordCount;

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
        $this->id_alumno->Visible = false;
        $this->nombre_alumno->setVisibility();
        $this->apellidos_alumno->setVisibility();
        $this->numcarnet_alumno->setVisibility();
        $this->genero_alumno->setVisibility();
        $this->fechanac_alumno->setVisibility();
        $this->direccion_alumno->setVisibility();
        $this->telefono_alumno->setVisibility();

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
        $this->setupLookupOptions($this->genero_alumno);

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("id_alumno") ?? Key(0) ?? Route(2)) !== null) {
                $this->id_alumno->setQueryStringValue($keyValue);
                $this->id_alumno->setOldValue($this->id_alumno->QueryStringValue);
            } elseif (Post("id_alumno") !== null) {
                $this->id_alumno->setFormValue(Post("id_alumno"));
                $this->id_alumno->setOldValue($this->id_alumno->FormValue);
            } else {
                $loaded = false; // Unable to load key
            }

            // Load record
            if ($loaded) {
                $loaded = $this->loadRow();
            }
            if (!$loaded) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                $this->terminate();
                return;
            }
            $this->CurrentAction = "update"; // Update record directly
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $postBack = true;
        } else {
            if (Post("action", "") !== "") {
                $this->CurrentAction = Post("action"); // Get action code
                if (!$this->isShow()) { // Not reload record, handle as postback
                    $postBack = true;
                }

                // Get key from Form
                $this->setKey(Post($this->OldKeyName), $this->isShow());
            } else {
                $this->CurrentAction = "show"; // Default action is display

                // Load key from QueryString
                $loadByQuery = false;
                if (($keyValue = Get("id_alumno") ?? Route("id_alumno")) !== null) {
                    $this->id_alumno->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->id_alumno->CurrentValue = null;
                }
            }

            // Load recordset
            if ($this->isShow()) {
                    // Load current record
                    $loaded = $this->loadRow();
                $this->OldKey = $loaded ? $this->getKey(true) : ""; // Get from CurrentValue
            }
        }

        // Process form if post back
        if ($postBack) {
            $this->loadFormValues(); // Get form values

            // Set up detail parameters
            $this->setupDetailParms();
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues();
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = ""; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "show": // Get a record to display
                    if (!$loaded) { // Load record based on key
                        if ($this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                        }
                        $this->terminate("AlumnotblList"); // No matching record, return to list
                        return;
                    }

                // Set up detail parameters
                $this->setupDetailParms();
                break;
            case "update": // Update
                if ($this->getCurrentDetailTable() != "") { // Master/detail edit
                    $returnUrl = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
                } else {
                    $returnUrl = $this->getReturnUrl();
                }
                if (GetPageName($returnUrl) == "AlumnotblList") {
                    $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                }
                $this->SendEmail = true; // Send email on update success
                if ($this->editRow()) {
                    // Handle UseAjaxActions with return page
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "AlumnotblList") {
                            Container("flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "AlumnotblList"; // Return list page content
                        }
                    }
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
                    }
                    if (IsJsonResponse()) {
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl); // Return to caller
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
                } elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
                    $this->terminate($returnUrl); // Return to caller
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Restore form values if update failed

                    // Set up detail parameters
                    $this->setupDetailParms();
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render the record
        $this->RowType = ROWTYPE_EDIT; // Render as Edit
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

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'nombre_alumno' first before field var 'x_nombre_alumno'
        $val = $CurrentForm->hasValue("nombre_alumno") ? $CurrentForm->getValue("nombre_alumno") : $CurrentForm->getValue("x_nombre_alumno");
        if (!$this->nombre_alumno->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nombre_alumno->Visible = false; // Disable update for API request
            } else {
                $this->nombre_alumno->setFormValue($val);
            }
        }

        // Check field name 'apellidos_alumno' first before field var 'x_apellidos_alumno'
        $val = $CurrentForm->hasValue("apellidos_alumno") ? $CurrentForm->getValue("apellidos_alumno") : $CurrentForm->getValue("x_apellidos_alumno");
        if (!$this->apellidos_alumno->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->apellidos_alumno->Visible = false; // Disable update for API request
            } else {
                $this->apellidos_alumno->setFormValue($val);
            }
        }

        // Check field name 'numcarnet_alumno' first before field var 'x_numcarnet_alumno'
        $val = $CurrentForm->hasValue("numcarnet_alumno") ? $CurrentForm->getValue("numcarnet_alumno") : $CurrentForm->getValue("x_numcarnet_alumno");
        if (!$this->numcarnet_alumno->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->numcarnet_alumno->Visible = false; // Disable update for API request
            } else {
                $this->numcarnet_alumno->setFormValue($val);
            }
        }

        // Check field name 'genero_alumno' first before field var 'x_genero_alumno'
        $val = $CurrentForm->hasValue("genero_alumno") ? $CurrentForm->getValue("genero_alumno") : $CurrentForm->getValue("x_genero_alumno");
        if (!$this->genero_alumno->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->genero_alumno->Visible = false; // Disable update for API request
            } else {
                $this->genero_alumno->setFormValue($val);
            }
        }

        // Check field name 'fechanac_alumno' first before field var 'x_fechanac_alumno'
        $val = $CurrentForm->hasValue("fechanac_alumno") ? $CurrentForm->getValue("fechanac_alumno") : $CurrentForm->getValue("x_fechanac_alumno");
        if (!$this->fechanac_alumno->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->fechanac_alumno->Visible = false; // Disable update for API request
            } else {
                $this->fechanac_alumno->setFormValue($val, true, $validate);
            }
            $this->fechanac_alumno->CurrentValue = UnFormatDateTime($this->fechanac_alumno->CurrentValue, $this->fechanac_alumno->formatPattern());
        }

        // Check field name 'direccion_alumno' first before field var 'x_direccion_alumno'
        $val = $CurrentForm->hasValue("direccion_alumno") ? $CurrentForm->getValue("direccion_alumno") : $CurrentForm->getValue("x_direccion_alumno");
        if (!$this->direccion_alumno->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->direccion_alumno->Visible = false; // Disable update for API request
            } else {
                $this->direccion_alumno->setFormValue($val);
            }
        }

        // Check field name 'telefono_alumno' first before field var 'x_telefono_alumno'
        $val = $CurrentForm->hasValue("telefono_alumno") ? $CurrentForm->getValue("telefono_alumno") : $CurrentForm->getValue("x_telefono_alumno");
        if (!$this->telefono_alumno->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->telefono_alumno->Visible = false; // Disable update for API request
            } else {
                $this->telefono_alumno->setFormValue($val);
            }
        }

        // Check field name 'id_alumno' first before field var 'x_id_alumno'
        $val = $CurrentForm->hasValue("id_alumno") ? $CurrentForm->getValue("id_alumno") : $CurrentForm->getValue("x_id_alumno");
        if (!$this->id_alumno->IsDetailKey) {
            $this->id_alumno->setFormValue($val);
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id_alumno->CurrentValue = $this->id_alumno->FormValue;
        $this->nombre_alumno->CurrentValue = $this->nombre_alumno->FormValue;
        $this->apellidos_alumno->CurrentValue = $this->apellidos_alumno->FormValue;
        $this->numcarnet_alumno->CurrentValue = $this->numcarnet_alumno->FormValue;
        $this->genero_alumno->CurrentValue = $this->genero_alumno->FormValue;
        $this->fechanac_alumno->CurrentValue = $this->fechanac_alumno->FormValue;
        $this->fechanac_alumno->CurrentValue = UnFormatDateTime($this->fechanac_alumno->CurrentValue, $this->fechanac_alumno->formatPattern());
        $this->direccion_alumno->CurrentValue = $this->direccion_alumno->FormValue;
        $this->telefono_alumno->CurrentValue = $this->telefono_alumno->FormValue;
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
        $this->id_alumno->setDbValue($row['id_alumno']);
        $this->nombre_alumno->setDbValue($row['nombre_alumno']);
        $this->apellidos_alumno->setDbValue($row['apellidos_alumno']);
        $this->numcarnet_alumno->setDbValue($row['numcarnet_alumno']);
        $this->genero_alumno->setDbValue($row['genero_alumno']);
        $this->fechanac_alumno->setDbValue($row['fechanac_alumno']);
        $this->direccion_alumno->setDbValue($row['direccion_alumno']);
        $this->telefono_alumno->setDbValue($row['telefono_alumno']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id_alumno'] = $this->id_alumno->DefaultValue;
        $row['nombre_alumno'] = $this->nombre_alumno->DefaultValue;
        $row['apellidos_alumno'] = $this->apellidos_alumno->DefaultValue;
        $row['numcarnet_alumno'] = $this->numcarnet_alumno->DefaultValue;
        $row['genero_alumno'] = $this->genero_alumno->DefaultValue;
        $row['fechanac_alumno'] = $this->fechanac_alumno->DefaultValue;
        $row['direccion_alumno'] = $this->direccion_alumno->DefaultValue;
        $row['telefono_alumno'] = $this->telefono_alumno->DefaultValue;
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

        // id_alumno
        $this->id_alumno->RowCssClass = "row";

        // nombre_alumno
        $this->nombre_alumno->RowCssClass = "row";

        // apellidos_alumno
        $this->apellidos_alumno->RowCssClass = "row";

        // numcarnet_alumno
        $this->numcarnet_alumno->RowCssClass = "row";

        // genero_alumno
        $this->genero_alumno->RowCssClass = "row";

        // fechanac_alumno
        $this->fechanac_alumno->RowCssClass = "row";

        // direccion_alumno
        $this->direccion_alumno->RowCssClass = "row";

        // telefono_alumno
        $this->telefono_alumno->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // nombre_alumno
            $this->nombre_alumno->ViewValue = $this->nombre_alumno->CurrentValue;

            // apellidos_alumno
            $this->apellidos_alumno->ViewValue = $this->apellidos_alumno->CurrentValue;

            // numcarnet_alumno
            $this->numcarnet_alumno->ViewValue = $this->numcarnet_alumno->CurrentValue;

            // genero_alumno
            if (ConvertToBool($this->genero_alumno->CurrentValue)) {
                $this->genero_alumno->ViewValue = $this->genero_alumno->tagCaption(1) != "" ? $this->genero_alumno->tagCaption(1) : "Masculino";
            } else {
                $this->genero_alumno->ViewValue = $this->genero_alumno->tagCaption(2) != "" ? $this->genero_alumno->tagCaption(2) : "Femenino";
            }

            // fechanac_alumno
            $this->fechanac_alumno->ViewValue = $this->fechanac_alumno->CurrentValue;
            $this->fechanac_alumno->ViewValue = FormatDateTime($this->fechanac_alumno->ViewValue, $this->fechanac_alumno->formatPattern());

            // direccion_alumno
            $this->direccion_alumno->ViewValue = $this->direccion_alumno->CurrentValue;

            // telefono_alumno
            $this->telefono_alumno->ViewValue = $this->telefono_alumno->CurrentValue;

            // nombre_alumno
            $this->nombre_alumno->HrefValue = "";

            // apellidos_alumno
            $this->apellidos_alumno->HrefValue = "";

            // numcarnet_alumno
            $this->numcarnet_alumno->HrefValue = "";

            // genero_alumno
            $this->genero_alumno->HrefValue = "";

            // fechanac_alumno
            $this->fechanac_alumno->HrefValue = "";

            // direccion_alumno
            $this->direccion_alumno->HrefValue = "";

            // telefono_alumno
            $this->telefono_alumno->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // nombre_alumno
            $this->nombre_alumno->setupEditAttributes();
            if (!$this->nombre_alumno->Raw) {
                $this->nombre_alumno->CurrentValue = HtmlDecode($this->nombre_alumno->CurrentValue);
            }
            $this->nombre_alumno->EditValue = HtmlEncode($this->nombre_alumno->CurrentValue);
            $this->nombre_alumno->PlaceHolder = RemoveHtml($this->nombre_alumno->caption());

            // apellidos_alumno
            $this->apellidos_alumno->setupEditAttributes();
            if (!$this->apellidos_alumno->Raw) {
                $this->apellidos_alumno->CurrentValue = HtmlDecode($this->apellidos_alumno->CurrentValue);
            }
            $this->apellidos_alumno->EditValue = HtmlEncode($this->apellidos_alumno->CurrentValue);
            $this->apellidos_alumno->PlaceHolder = RemoveHtml($this->apellidos_alumno->caption());

            // numcarnet_alumno
            $this->numcarnet_alumno->setupEditAttributes();
            if (!$this->numcarnet_alumno->Raw) {
                $this->numcarnet_alumno->CurrentValue = HtmlDecode($this->numcarnet_alumno->CurrentValue);
            }
            $this->numcarnet_alumno->EditValue = HtmlEncode($this->numcarnet_alumno->CurrentValue);
            $this->numcarnet_alumno->PlaceHolder = RemoveHtml($this->numcarnet_alumno->caption());

            // genero_alumno
            $this->genero_alumno->EditValue = $this->genero_alumno->options(false);
            $this->genero_alumno->PlaceHolder = RemoveHtml($this->genero_alumno->caption());

            // fechanac_alumno
            $this->fechanac_alumno->setupEditAttributes();
            $this->fechanac_alumno->EditValue = HtmlEncode(FormatDateTime($this->fechanac_alumno->CurrentValue, $this->fechanac_alumno->formatPattern()));
            $this->fechanac_alumno->PlaceHolder = RemoveHtml($this->fechanac_alumno->caption());

            // direccion_alumno
            $this->direccion_alumno->setupEditAttributes();
            if (!$this->direccion_alumno->Raw) {
                $this->direccion_alumno->CurrentValue = HtmlDecode($this->direccion_alumno->CurrentValue);
            }
            $this->direccion_alumno->EditValue = HtmlEncode($this->direccion_alumno->CurrentValue);
            $this->direccion_alumno->PlaceHolder = RemoveHtml($this->direccion_alumno->caption());

            // telefono_alumno
            $this->telefono_alumno->setupEditAttributes();
            if (!$this->telefono_alumno->Raw) {
                $this->telefono_alumno->CurrentValue = HtmlDecode($this->telefono_alumno->CurrentValue);
            }
            $this->telefono_alumno->EditValue = HtmlEncode($this->telefono_alumno->CurrentValue);
            $this->telefono_alumno->PlaceHolder = RemoveHtml($this->telefono_alumno->caption());

            // Edit refer script

            // nombre_alumno
            $this->nombre_alumno->HrefValue = "";

            // apellidos_alumno
            $this->apellidos_alumno->HrefValue = "";

            // numcarnet_alumno
            $this->numcarnet_alumno->HrefValue = "";

            // genero_alumno
            $this->genero_alumno->HrefValue = "";

            // fechanac_alumno
            $this->fechanac_alumno->HrefValue = "";

            // direccion_alumno
            $this->direccion_alumno->HrefValue = "";

            // telefono_alumno
            $this->telefono_alumno->HrefValue = "";
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
        if ($this->nombre_alumno->Required) {
            if (!$this->nombre_alumno->IsDetailKey && EmptyValue($this->nombre_alumno->FormValue)) {
                $this->nombre_alumno->addErrorMessage(str_replace("%s", $this->nombre_alumno->caption(), $this->nombre_alumno->RequiredErrorMessage));
            }
        }
        if ($this->apellidos_alumno->Required) {
            if (!$this->apellidos_alumno->IsDetailKey && EmptyValue($this->apellidos_alumno->FormValue)) {
                $this->apellidos_alumno->addErrorMessage(str_replace("%s", $this->apellidos_alumno->caption(), $this->apellidos_alumno->RequiredErrorMessage));
            }
        }
        if ($this->numcarnet_alumno->Required) {
            if (!$this->numcarnet_alumno->IsDetailKey && EmptyValue($this->numcarnet_alumno->FormValue)) {
                $this->numcarnet_alumno->addErrorMessage(str_replace("%s", $this->numcarnet_alumno->caption(), $this->numcarnet_alumno->RequiredErrorMessage));
            }
        }
        if ($this->genero_alumno->Required) {
            if ($this->genero_alumno->FormValue == "") {
                $this->genero_alumno->addErrorMessage(str_replace("%s", $this->genero_alumno->caption(), $this->genero_alumno->RequiredErrorMessage));
            }
        }
        if ($this->fechanac_alumno->Required) {
            if (!$this->fechanac_alumno->IsDetailKey && EmptyValue($this->fechanac_alumno->FormValue)) {
                $this->fechanac_alumno->addErrorMessage(str_replace("%s", $this->fechanac_alumno->caption(), $this->fechanac_alumno->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->fechanac_alumno->FormValue, $this->fechanac_alumno->formatPattern())) {
            $this->fechanac_alumno->addErrorMessage($this->fechanac_alumno->getErrorMessage(false));
        }
        if ($this->direccion_alumno->Required) {
            if (!$this->direccion_alumno->IsDetailKey && EmptyValue($this->direccion_alumno->FormValue)) {
                $this->direccion_alumno->addErrorMessage(str_replace("%s", $this->direccion_alumno->caption(), $this->direccion_alumno->RequiredErrorMessage));
            }
        }
        if ($this->telefono_alumno->Required) {
            if (!$this->telefono_alumno->IsDetailKey && EmptyValue($this->telefono_alumno->FormValue)) {
                $this->telefono_alumno->addErrorMessage(str_replace("%s", $this->telefono_alumno->caption(), $this->telefono_alumno->RequiredErrorMessage));
            }
        }

        // Validate detail grid
        $detailTblVar = explode(",", $this->getCurrentDetailTable());
        $detailPage = Container("CalificacionTblGrid");
        if (in_array("calificacion_tbl", $detailTblVar) && $detailPage->DetailEdit) {
            $validateForm = $validateForm && $detailPage->validateGridForm();
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

    // Update record based on key values
    protected function editRow()
    {
        global $Security, $Language;
        $oldKeyFilter = $this->getRecordFilter();
        $filter = $this->applyUserIDFilters($oldKeyFilter);
        $conn = $this->getConnection();

        // Load old row
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $rsold = $conn->fetchAssociative($sql);
        if (!$rsold) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
            return false; // Update Failed
        } else {
            // Save old values
            $this->loadDbValues($rsold);
        }

        // Set new row
        $rsnew = [];

        // nombre_alumno
        $this->nombre_alumno->setDbValueDef($rsnew, $this->nombre_alumno->CurrentValue, "", $this->nombre_alumno->ReadOnly);

        // apellidos_alumno
        $this->apellidos_alumno->setDbValueDef($rsnew, $this->apellidos_alumno->CurrentValue, "", $this->apellidos_alumno->ReadOnly);

        // numcarnet_alumno
        $this->numcarnet_alumno->setDbValueDef($rsnew, $this->numcarnet_alumno->CurrentValue, "", $this->numcarnet_alumno->ReadOnly);

        // genero_alumno
        $this->genero_alumno->setDbValueDef($rsnew, strval($this->genero_alumno->CurrentValue) == "1" ? "1" : "0", null, $this->genero_alumno->ReadOnly);

        // fechanac_alumno
        $this->fechanac_alumno->setDbValueDef($rsnew, UnFormatDateTime($this->fechanac_alumno->CurrentValue, $this->fechanac_alumno->formatPattern()), null, $this->fechanac_alumno->ReadOnly);

        // direccion_alumno
        $this->direccion_alumno->setDbValueDef($rsnew, $this->direccion_alumno->CurrentValue, null, $this->direccion_alumno->ReadOnly);

        // telefono_alumno
        $this->telefono_alumno->setDbValueDef($rsnew, $this->telefono_alumno->CurrentValue, null, $this->telefono_alumno->ReadOnly);

        // Update current values
        $this->setCurrentValues($rsnew);

        // Begin transaction
        if ($this->getCurrentDetailTable() != "" && $this->UseTransaction) {
            $conn->beginTransaction();
        }

        // Call Row Updating event
        $updateRow = $this->rowUpdating($rsold, $rsnew);
        if ($updateRow) {
            if (count($rsnew) > 0) {
                $this->CurrentFilter = $filter; // Set up current filter
                $editRow = $this->update($rsnew, "", $rsold);
                if (!$editRow && !EmptyValue($this->DbErrorMessage)) { // Show database error
                    $this->setFailureMessage($this->DbErrorMessage);
                }
            } else {
                $editRow = true; // No field to update
            }
            if ($editRow) {
            }

            // Update detail records
            $detailTblVar = explode(",", $this->getCurrentDetailTable());
            if ($editRow) {
                $detailPage = Container("CalificacionTblGrid");
                if (in_array("calificacion_tbl", $detailTblVar) && $detailPage->DetailEdit) {
                    $Security->loadCurrentUserLevel($this->ProjectID . "calificacion_tbl"); // Load user level of detail table
                    $editRow = $detailPage->gridUpdate();
                    $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                }
            }

            // Commit/Rollback transaction
            if ($this->getCurrentDetailTable() != "") {
                if ($editRow) {
                    if ($this->UseTransaction) { // Commit transaction
                        $conn->commit();
                    }
                } else {
                    if ($this->UseTransaction) { // Rollback transaction
                        $conn->rollback();
                    }
                }
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("UpdateCancelled"));
            }
            $editRow = false;
        }

        // Call Row_Updated event
        if ($editRow) {
            $this->rowUpdated($rsold, $rsnew);
        }

        // Write JSON response
        if (IsJsonResponse() && $editRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            $table = $this->TableVar;
            WriteJson(["success" => true, "action" => Config("API_EDIT_ACTION"), $table => $row]);
        }
        return $editRow;
    }

    // Set up detail parms based on QueryString
    protected function setupDetailParms()
    {
        // Get the keys for master table
        $detailTblVar = Get(Config("TABLE_SHOW_DETAIL"));
        if ($detailTblVar !== null) {
            $this->setCurrentDetailTable($detailTblVar);
        } else {
            $detailTblVar = $this->getCurrentDetailTable();
        }
        if ($detailTblVar != "") {
            $detailTblVar = explode(",", $detailTblVar);
            if (in_array("calificacion_tbl", $detailTblVar)) {
                $detailPageObj = Container("CalificacionTblGrid");
                if ($detailPageObj->DetailEdit) {
                    $detailPageObj->EventCancelled = $this->EventCancelled;
                    $detailPageObj->CurrentMode = "edit";
                    $detailPageObj->CurrentAction = "gridedit";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->fk_id_alumno->IsDetailKey = true;
                    $detailPageObj->fk_id_alumno->CurrentValue = $this->id_alumno->CurrentValue;
                    $detailPageObj->fk_id_alumno->setSessionValue($detailPageObj->fk_id_alumno->CurrentValue);
                    $detailPageObj->fk_id_asignatura->setSessionValue(""); // Clear session key
                }
            }
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("AlumnotblList"), "", $this->TableVar, true);
        $pageId = "edit";
        $Breadcrumb->add("edit", $pageId, $url);
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
                case "x_genero_alumno":
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

    // Set up starting record parameters
    public function setupStartRecord()
    {
        if ($this->DisplayRecords == 0) {
            return;
        }
        $pageNo = Get(Config("TABLE_PAGE_NUMBER"));
        $startRec = Get(Config("TABLE_START_REC"));
        $infiniteScroll = false;
        $recordNo = $pageNo ?? $startRec; // Record number = page number or start record
        if ($recordNo !== null && is_numeric($recordNo)) {
            $this->StartRecord = $recordNo;
        } else {
            $this->StartRecord = $this->getStartRecordNumber();
        }

        // Check if correct start record counter
        if (!is_numeric($this->StartRecord) || intval($this->StartRecord) <= 0) { // Avoid invalid start record counter
            $this->StartRecord = 1; // Reset start record counter
        } elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
            $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
        } elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
            $this->StartRecord = (int)(($this->StartRecord - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
        }
        if (!$infiniteScroll) {
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Get page count
    public function pageCount() {
        return ceil($this->TotalRecords / $this->DisplayRecords);
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
