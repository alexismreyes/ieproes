<?php

namespace PHPMaker2023\ieproes;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class CalificacionTblAdd extends CalificacionTbl
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "CalificacionTblAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "CalificacionTblAdd";

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
        $this->TableVar = 'calificacion_tbl';
        $this->TableName = 'calificacion_tbl';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-add-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Table object (calificacion_tbl)
        if (!isset($GLOBALS["calificacion_tbl"]) || get_class($GLOBALS["calificacion_tbl"]) == PROJECT_NAMESPACE . "calificacion_tbl") {
            $GLOBALS["calificacion_tbl"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'calificacion_tbl');
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
                    $result["view"] = $pageName == "CalificacionTblView"; // If View page, no primary button
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
            $key .= @$ar['id_calificacion'];
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
            $this->id_calificacion->Visible = false;
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
        $this->id_calificacion->Visible = false;
        $this->fk_id_asignatura->setVisibility();
        $this->fk_id_alumno->setVisibility();
        $this->nota_calificacion->setVisibility();
        $this->observacion_calificacion->setVisibility();
        $this->fk_id_evaluacion->setVisibility();

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
        $this->setupLookupOptions($this->fk_id_asignatura);
        $this->setupLookupOptions($this->fk_id_alumno);
        $this->setupLookupOptions($this->fk_id_evaluacion);

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
            if (($keyValue = Get("id_calificacion") ?? Route("id_calificacion")) !== null) {
                $this->id_calificacion->setQueryStringValue($keyValue);
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

        // Set up master/detail parameters
        // NOTE: Must be after loadOldRecord to prevent master key values being overwritten
        $this->setupMasterParms();

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
                    $this->terminate("CalificacionTblList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "CalificacionTblList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "CalificacionTblView") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }

                    // Handle UseAjaxActions
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "CalificacionTblList") {
                            Container("flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "CalificacionTblList"; // Return list page content
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

        // Check field name 'fk_id_asignatura' first before field var 'x_fk_id_asignatura'
        $val = $CurrentForm->hasValue("fk_id_asignatura") ? $CurrentForm->getValue("fk_id_asignatura") : $CurrentForm->getValue("x_fk_id_asignatura");
        if (!$this->fk_id_asignatura->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->fk_id_asignatura->Visible = false; // Disable update for API request
            } else {
                $this->fk_id_asignatura->setFormValue($val);
            }
        }

        // Check field name 'fk_id_alumno' first before field var 'x_fk_id_alumno'
        $val = $CurrentForm->hasValue("fk_id_alumno") ? $CurrentForm->getValue("fk_id_alumno") : $CurrentForm->getValue("x_fk_id_alumno");
        if (!$this->fk_id_alumno->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->fk_id_alumno->Visible = false; // Disable update for API request
            } else {
                $this->fk_id_alumno->setFormValue($val);
            }
        }

        // Check field name 'nota_calificacion' first before field var 'x_nota_calificacion'
        $val = $CurrentForm->hasValue("nota_calificacion") ? $CurrentForm->getValue("nota_calificacion") : $CurrentForm->getValue("x_nota_calificacion");
        if (!$this->nota_calificacion->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nota_calificacion->Visible = false; // Disable update for API request
            } else {
                $this->nota_calificacion->setFormValue($val);
            }
        }

        // Check field name 'observacion_calificacion' first before field var 'x_observacion_calificacion'
        $val = $CurrentForm->hasValue("observacion_calificacion") ? $CurrentForm->getValue("observacion_calificacion") : $CurrentForm->getValue("x_observacion_calificacion");
        if (!$this->observacion_calificacion->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->observacion_calificacion->Visible = false; // Disable update for API request
            } else {
                $this->observacion_calificacion->setFormValue($val);
            }
        }

        // Check field name 'fk_id_evaluacion' first before field var 'x_fk_id_evaluacion'
        $val = $CurrentForm->hasValue("fk_id_evaluacion") ? $CurrentForm->getValue("fk_id_evaluacion") : $CurrentForm->getValue("x_fk_id_evaluacion");
        if (!$this->fk_id_evaluacion->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->fk_id_evaluacion->Visible = false; // Disable update for API request
            } else {
                $this->fk_id_evaluacion->setFormValue($val);
            }
        }

        // Check field name 'id_calificacion' first before field var 'x_id_calificacion'
        $val = $CurrentForm->hasValue("id_calificacion") ? $CurrentForm->getValue("id_calificacion") : $CurrentForm->getValue("x_id_calificacion");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->fk_id_asignatura->CurrentValue = $this->fk_id_asignatura->FormValue;
        $this->fk_id_alumno->CurrentValue = $this->fk_id_alumno->FormValue;
        $this->nota_calificacion->CurrentValue = $this->nota_calificacion->FormValue;
        $this->observacion_calificacion->CurrentValue = $this->observacion_calificacion->FormValue;
        $this->fk_id_evaluacion->CurrentValue = $this->fk_id_evaluacion->FormValue;
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
        $this->id_calificacion->setDbValue($row['id_calificacion']);
        $this->fk_id_asignatura->setDbValue($row['fk_id_asignatura']);
        $this->fk_id_alumno->setDbValue($row['fk_id_alumno']);
        $this->nota_calificacion->setDbValue($row['nota_calificacion']);
        $this->observacion_calificacion->setDbValue($row['observacion_calificacion']);
        $this->fk_id_evaluacion->setDbValue($row['fk_id_evaluacion']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id_calificacion'] = $this->id_calificacion->DefaultValue;
        $row['fk_id_asignatura'] = $this->fk_id_asignatura->DefaultValue;
        $row['fk_id_alumno'] = $this->fk_id_alumno->DefaultValue;
        $row['nota_calificacion'] = $this->nota_calificacion->DefaultValue;
        $row['observacion_calificacion'] = $this->observacion_calificacion->DefaultValue;
        $row['fk_id_evaluacion'] = $this->fk_id_evaluacion->DefaultValue;
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

        // id_calificacion
        $this->id_calificacion->RowCssClass = "row";

        // fk_id_asignatura
        $this->fk_id_asignatura->RowCssClass = "row";

        // fk_id_alumno
        $this->fk_id_alumno->RowCssClass = "row";

        // nota_calificacion
        $this->nota_calificacion->RowCssClass = "row";

        // observacion_calificacion
        $this->observacion_calificacion->RowCssClass = "row";

        // fk_id_evaluacion
        $this->fk_id_evaluacion->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // fk_id_asignatura
            $curVal = strval($this->fk_id_asignatura->CurrentValue);
            if ($curVal != "") {
                $this->fk_id_asignatura->ViewValue = $this->fk_id_asignatura->lookupCacheOption($curVal);
                if ($this->fk_id_asignatura->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter("`id_asignatura`", "=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->fk_id_asignatura->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->fk_id_asignatura->Lookup->renderViewRow($rswrk[0]);
                        $this->fk_id_asignatura->ViewValue = $this->fk_id_asignatura->displayValue($arwrk);
                    } else {
                        $this->fk_id_asignatura->ViewValue = FormatNumber($this->fk_id_asignatura->CurrentValue, $this->fk_id_asignatura->formatPattern());
                    }
                }
            } else {
                $this->fk_id_asignatura->ViewValue = null;
            }

            // fk_id_alumno
            $curVal = strval($this->fk_id_alumno->CurrentValue);
            if ($curVal != "") {
                $this->fk_id_alumno->ViewValue = $this->fk_id_alumno->lookupCacheOption($curVal);
                if ($this->fk_id_alumno->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter("`id_alumno`", "=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->fk_id_alumno->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->fk_id_alumno->Lookup->renderViewRow($rswrk[0]);
                        $this->fk_id_alumno->ViewValue = $this->fk_id_alumno->displayValue($arwrk);
                    } else {
                        $this->fk_id_alumno->ViewValue = FormatNumber($this->fk_id_alumno->CurrentValue, $this->fk_id_alumno->formatPattern());
                    }
                }
            } else {
                $this->fk_id_alumno->ViewValue = null;
            }

            // nota_calificacion
            $this->nota_calificacion->ViewValue = $this->nota_calificacion->CurrentValue;

            // observacion_calificacion
            $this->observacion_calificacion->ViewValue = $this->observacion_calificacion->CurrentValue;

            // fk_id_evaluacion
            $curVal = strval($this->fk_id_evaluacion->CurrentValue);
            if ($curVal != "") {
                $this->fk_id_evaluacion->ViewValue = $this->fk_id_evaluacion->lookupCacheOption($curVal);
                if ($this->fk_id_evaluacion->ViewValue === null) { // Lookup from database
                    $filterWrk = SearchFilter("`id_evaluacion`", "=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->fk_id_evaluacion->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->fk_id_evaluacion->Lookup->renderViewRow($rswrk[0]);
                        $this->fk_id_evaluacion->ViewValue = $this->fk_id_evaluacion->displayValue($arwrk);
                    } else {
                        $this->fk_id_evaluacion->ViewValue = FormatNumber($this->fk_id_evaluacion->CurrentValue, $this->fk_id_evaluacion->formatPattern());
                    }
                }
            } else {
                $this->fk_id_evaluacion->ViewValue = null;
            }

            // fk_id_asignatura
            $this->fk_id_asignatura->HrefValue = "";

            // fk_id_alumno
            $this->fk_id_alumno->HrefValue = "";

            // nota_calificacion
            $this->nota_calificacion->HrefValue = "";

            // observacion_calificacion
            $this->observacion_calificacion->HrefValue = "";

            // fk_id_evaluacion
            $this->fk_id_evaluacion->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // fk_id_asignatura
            $this->fk_id_asignatura->setupEditAttributes();
            if ($this->fk_id_asignatura->getSessionValue() != "") {
                $this->fk_id_asignatura->CurrentValue = GetForeignKeyValue($this->fk_id_asignatura->getSessionValue());
                $curVal = strval($this->fk_id_asignatura->CurrentValue);
                if ($curVal != "") {
                    $this->fk_id_asignatura->ViewValue = $this->fk_id_asignatura->lookupCacheOption($curVal);
                    if ($this->fk_id_asignatura->ViewValue === null) { // Lookup from database
                        $filterWrk = SearchFilter("`id_asignatura`", "=", $curVal, DATATYPE_NUMBER, "");
                        $sqlWrk = $this->fk_id_asignatura->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                        $conn = Conn();
                        $config = $conn->getConfiguration();
                        $config->setResultCacheImpl($this->Cache);
                        $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                        $ari = count($rswrk);
                        if ($ari > 0) { // Lookup values found
                            $arwrk = $this->fk_id_asignatura->Lookup->renderViewRow($rswrk[0]);
                            $this->fk_id_asignatura->ViewValue = $this->fk_id_asignatura->displayValue($arwrk);
                        } else {
                            $this->fk_id_asignatura->ViewValue = FormatNumber($this->fk_id_asignatura->CurrentValue, $this->fk_id_asignatura->formatPattern());
                        }
                    }
                } else {
                    $this->fk_id_asignatura->ViewValue = null;
                }
            } else {
                $curVal = trim(strval($this->fk_id_asignatura->CurrentValue));
                if ($curVal != "") {
                    $this->fk_id_asignatura->ViewValue = $this->fk_id_asignatura->lookupCacheOption($curVal);
                } else {
                    $this->fk_id_asignatura->ViewValue = $this->fk_id_asignatura->Lookup !== null && is_array($this->fk_id_asignatura->lookupOptions()) ? $curVal : null;
                }
                if ($this->fk_id_asignatura->ViewValue !== null) { // Load from cache
                    $this->fk_id_asignatura->EditValue = array_values($this->fk_id_asignatura->lookupOptions());
                } else { // Lookup from database
                    if ($curVal == "") {
                        $filterWrk = "0=1";
                    } else {
                        $filterWrk = SearchFilter("`id_asignatura`", "=", $this->fk_id_asignatura->CurrentValue, DATATYPE_NUMBER, "");
                    }
                    $sqlWrk = $this->fk_id_asignatura->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    $arwrk = $rswrk;
                    $this->fk_id_asignatura->EditValue = $arwrk;
                }
                $this->fk_id_asignatura->PlaceHolder = RemoveHtml($this->fk_id_asignatura->caption());
            }

            // fk_id_alumno
            $this->fk_id_alumno->setupEditAttributes();
            $curVal = trim(strval($this->fk_id_alumno->CurrentValue));
            if ($curVal != "") {
                $this->fk_id_alumno->ViewValue = $this->fk_id_alumno->lookupCacheOption($curVal);
            } else {
                $this->fk_id_alumno->ViewValue = $this->fk_id_alumno->Lookup !== null && is_array($this->fk_id_alumno->lookupOptions()) ? $curVal : null;
            }
            if ($this->fk_id_alumno->ViewValue !== null) { // Load from cache
                $this->fk_id_alumno->EditValue = array_values($this->fk_id_alumno->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter("`id_alumno`", "=", $this->fk_id_alumno->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->fk_id_alumno->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->fk_id_alumno->EditValue = $arwrk;
            }
            $this->fk_id_alumno->PlaceHolder = RemoveHtml($this->fk_id_alumno->caption());

            // nota_calificacion
            $this->nota_calificacion->setupEditAttributes();
            if (!$this->nota_calificacion->Raw) {
                $this->nota_calificacion->CurrentValue = HtmlDecode($this->nota_calificacion->CurrentValue);
            }
            $this->nota_calificacion->EditValue = HtmlEncode($this->nota_calificacion->CurrentValue);
            $this->nota_calificacion->PlaceHolder = RemoveHtml($this->nota_calificacion->caption());

            // observacion_calificacion
            $this->observacion_calificacion->setupEditAttributes();
            $this->observacion_calificacion->EditValue = HtmlEncode($this->observacion_calificacion->CurrentValue);
            $this->observacion_calificacion->PlaceHolder = RemoveHtml($this->observacion_calificacion->caption());

            // fk_id_evaluacion
            $this->fk_id_evaluacion->setupEditAttributes();
            $curVal = trim(strval($this->fk_id_evaluacion->CurrentValue));
            if ($curVal != "") {
                $this->fk_id_evaluacion->ViewValue = $this->fk_id_evaluacion->lookupCacheOption($curVal);
            } else {
                $this->fk_id_evaluacion->ViewValue = $this->fk_id_evaluacion->Lookup !== null && is_array($this->fk_id_evaluacion->lookupOptions()) ? $curVal : null;
            }
            if ($this->fk_id_evaluacion->ViewValue !== null) { // Load from cache
                $this->fk_id_evaluacion->EditValue = array_values($this->fk_id_evaluacion->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter("`id_evaluacion`", "=", $this->fk_id_evaluacion->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->fk_id_evaluacion->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->fk_id_evaluacion->EditValue = $arwrk;
            }
            $this->fk_id_evaluacion->PlaceHolder = RemoveHtml($this->fk_id_evaluacion->caption());

            // Add refer script

            // fk_id_asignatura
            $this->fk_id_asignatura->HrefValue = "";

            // fk_id_alumno
            $this->fk_id_alumno->HrefValue = "";

            // nota_calificacion
            $this->nota_calificacion->HrefValue = "";

            // observacion_calificacion
            $this->observacion_calificacion->HrefValue = "";

            // fk_id_evaluacion
            $this->fk_id_evaluacion->HrefValue = "";
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
        if ($this->fk_id_asignatura->Required) {
            if (!$this->fk_id_asignatura->IsDetailKey && EmptyValue($this->fk_id_asignatura->FormValue)) {
                $this->fk_id_asignatura->addErrorMessage(str_replace("%s", $this->fk_id_asignatura->caption(), $this->fk_id_asignatura->RequiredErrorMessage));
            }
        }
        if ($this->fk_id_alumno->Required) {
            if (!$this->fk_id_alumno->IsDetailKey && EmptyValue($this->fk_id_alumno->FormValue)) {
                $this->fk_id_alumno->addErrorMessage(str_replace("%s", $this->fk_id_alumno->caption(), $this->fk_id_alumno->RequiredErrorMessage));
            }
        }
        if ($this->nota_calificacion->Required) {
            if (!$this->nota_calificacion->IsDetailKey && EmptyValue($this->nota_calificacion->FormValue)) {
                $this->nota_calificacion->addErrorMessage(str_replace("%s", $this->nota_calificacion->caption(), $this->nota_calificacion->RequiredErrorMessage));
            }
        }
        if ($this->observacion_calificacion->Required) {
            if (!$this->observacion_calificacion->IsDetailKey && EmptyValue($this->observacion_calificacion->FormValue)) {
                $this->observacion_calificacion->addErrorMessage(str_replace("%s", $this->observacion_calificacion->caption(), $this->observacion_calificacion->RequiredErrorMessage));
            }
        }
        if ($this->fk_id_evaluacion->Required) {
            if (!$this->fk_id_evaluacion->IsDetailKey && EmptyValue($this->fk_id_evaluacion->FormValue)) {
                $this->fk_id_evaluacion->addErrorMessage(str_replace("%s", $this->fk_id_evaluacion->caption(), $this->fk_id_evaluacion->RequiredErrorMessage));
            }
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

        // fk_id_asignatura
        $this->fk_id_asignatura->setDbValueDef($rsnew, $this->fk_id_asignatura->CurrentValue, 0, false);

        // fk_id_alumno
        $this->fk_id_alumno->setDbValueDef($rsnew, $this->fk_id_alumno->CurrentValue, 0, false);

        // nota_calificacion
        $this->nota_calificacion->setDbValueDef($rsnew, $this->nota_calificacion->CurrentValue, "", false);

        // observacion_calificacion
        $this->observacion_calificacion->setDbValueDef($rsnew, $this->observacion_calificacion->CurrentValue, null, false);

        // fk_id_evaluacion
        $this->fk_id_evaluacion->setDbValueDef($rsnew, $this->fk_id_evaluacion->CurrentValue, 0, false);

        // Update current values
        $this->setCurrentValues($rsnew);

        // Check if valid key values for master user
        if ($Security->currentUserID() != "" && !$Security->isAdmin()) { // Non system admin
            $detailKeys = [];
            $detailKeys["fk_id_asignatura"] = $this->fk_id_asignatura->CurrentValue;
            $masterTable = Container("asignatura_tbl");
            $masterFilter = $this->getMasterFilter($masterTable, $detailKeys);
            if (!EmptyValue($masterFilter)) {
                $validMasterKey = true;
                if ($rsmaster = $masterTable->loadRs($masterFilter)->fetchAssociative()) {
                    $validMasterKey = $Security->isValidUserID($rsmaster['id_profesor']);
                } elseif ($this->getCurrentMasterTable() == "asignatura_tbl") {
                    $validMasterKey = false;
                }
                if (!$validMasterKey) {
                    $masterUserIdMsg = str_replace("%c", CurrentUserID(), $Language->phrase("UnAuthorizedMasterUserID"));
                    $masterUserIdMsg = str_replace("%f", $masterFilter, $masterUserIdMsg);
                    $this->setFailureMessage($masterUserIdMsg);
                    return false;
                }
            }
        }

        // Check referential integrity for master table 'calificacion_tbl'
        $validMasterRecord = true;
        $detailKeys = [];
        $detailKeys["fk_id_asignatura"] = $this->fk_id_asignatura->CurrentValue;
        $masterTable = Container("asignatura_tbl");
        $masterFilter = $this->getMasterFilter($masterTable, $detailKeys);
        if (!EmptyValue($masterFilter)) {
            $rsmaster = $masterTable->loadRs($masterFilter)->fetch();
            $validMasterRecord = $rsmaster !== false;
        } else { // Allow null value if not required field
            $validMasterRecord = $masterFilter === null;
        }
        if (!$validMasterRecord) {
            $relatedRecordMsg = str_replace("%t", "asignatura_tbl", $Language->phrase("RelatedRecordRequired"));
            $this->setFailureMessage($relatedRecordMsg);
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

    // Set up master/detail based on QueryString
    protected function setupMasterParms()
    {
        $validMaster = false;
        $foreignKeys = [];
        // Get the keys for master table
        if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== null) {
            $masterTblVar = $master;
            if ($masterTblVar == "") {
                $validMaster = true;
                $this->DbMasterFilter = "";
                $this->DbDetailFilter = "";
            }
            if ($masterTblVar == "asignatura_tbl") {
                $validMaster = true;
                $masterTbl = Container("asignatura_tbl");
                if (($parm = Get("fk_id_asignatura", Get("fk_id_asignatura"))) !== null) {
                    $masterTbl->id_asignatura->setQueryStringValue($parm);
                    $this->fk_id_asignatura->QueryStringValue = $masterTbl->id_asignatura->QueryStringValue; // DO NOT change, master/detail key data type can be different
                    $this->fk_id_asignatura->setSessionValue($this->fk_id_asignatura->QueryStringValue);
                    $foreignKeys["fk_id_asignatura"] = $this->fk_id_asignatura->QueryStringValue;
                    if (!is_numeric($masterTbl->id_asignatura->QueryStringValue)) {
                        $validMaster = false;
                    }
                } else {
                    $validMaster = false;
                }
            }
        } elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== null) {
            $masterTblVar = $master;
            if ($masterTblVar == "") {
                    $validMaster = true;
                    $this->DbMasterFilter = "";
                    $this->DbDetailFilter = "";
            }
            if ($masterTblVar == "asignatura_tbl") {
                $validMaster = true;
                $masterTbl = Container("asignatura_tbl");
                if (($parm = Post("fk_id_asignatura", Post("fk_id_asignatura"))) !== null) {
                    $masterTbl->id_asignatura->setFormValue($parm);
                    $this->fk_id_asignatura->FormValue = $masterTbl->id_asignatura->FormValue;
                    $this->fk_id_asignatura->setSessionValue($this->fk_id_asignatura->FormValue);
                    $foreignKeys["fk_id_asignatura"] = $this->fk_id_asignatura->FormValue;
                    if (!is_numeric($masterTbl->id_asignatura->FormValue)) {
                        $validMaster = false;
                    }
                } else {
                    $validMaster = false;
                }
            }
        }
        if ($validMaster) {
            // Save current master table
            $this->setCurrentMasterTable($masterTblVar);

            // Reset start record counter (new master key)
            if (!$this->isAddOrEdit()) {
                $this->StartRecord = 1;
                $this->setStartRecordNumber($this->StartRecord);
            }

            // Clear previous master key from Session
            if ($masterTblVar != "asignatura_tbl") {
                if (!array_key_exists("fk_id_asignatura", $foreignKeys)) { // Not current foreign key
                    $this->fk_id_asignatura->setSessionValue("");
                }
            }
        }
        $this->DbMasterFilter = $this->getMasterFilterFromSession(); // Get master filter from session
        $this->DbDetailFilter = $this->getDetailFilterFromSession(); // Get detail filter from session
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("CalificacionTblList"), "", $this->TableVar, true);
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
                case "x_fk_id_asignatura":
                    break;
                case "x_fk_id_alumno":
                    break;
                case "x_fk_id_evaluacion":
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
