<?php

namespace PHPMaker2023\ieproes;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for calificacion_tbl
 */
class CalificacionTbl extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $DbErrorMessage = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Ajax / Modal
    public $UseAjaxActions = false;
    public $ModalSearch = false;
    public $ModalView = false;
    public $ModalAdd = true;
    public $ModalEdit = false;
    public $ModalUpdate = false;
    public $InlineDelete = false;
    public $ModalGridAdd = false;
    public $ModalGridEdit = false;
    public $ModalMultiEdit = false;

    // Fields
    public $id_calificacion;
    public $fk_id_asignatura;
    public $fk_id_alumno;
    public $nota_calificacion;
    public $observacion_calificacion;
    public $fk_id_evaluacion;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $CurrentLanguage, $CurrentLocale;

        // Language object
        $Language = Container("language");
        $this->TableVar = "calificacion_tbl";
        $this->TableName = 'calificacion_tbl';
        $this->TableType = "TABLE";
        $this->ImportUseTransaction = $this->supportsTransaction() && Config("IMPORT_USE_TRANSACTION");
        $this->UseTransaction = $this->supportsTransaction() && Config("USE_TRANSACTION");

        // Update Table
        $this->UpdateTable = "`calificacion_tbl`";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)

        // PDF
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)

        // PhpSpreadsheet
        $this->ExportExcelPageOrientation = null; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = null; // Page size (PhpSpreadsheet only)

        // PHPWord
        $this->ExportWordPageOrientation = ""; // Page orientation (PHPWord only)
        $this->ExportWordPageSize = ""; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 3;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UseAjaxActions = $this->UseAjaxActions || Config("USE_AJAX_ACTIONS");
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this);

        // id_calificacion
        $this->id_calificacion = new DbField(
            $this, // Table
            'x_id_calificacion', // Variable name
            'id_calificacion', // Name
            '`id_calificacion`', // Expression
            '`id_calificacion`', // Basic search expression
            19, // Type
            10, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`id_calificacion`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'NO' // Edit Tag
        );
        $this->id_calificacion->InputTextType = "text";
        $this->id_calificacion->IsAutoIncrement = true; // Autoincrement field
        $this->id_calificacion->IsPrimaryKey = true; // Primary key field
        $this->id_calificacion->Sortable = false; // Allow sort
        $this->id_calificacion->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_calificacion->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['id_calificacion'] = &$this->id_calificacion;

        // fk_id_asignatura
        $this->fk_id_asignatura = new DbField(
            $this, // Table
            'x_fk_id_asignatura', // Variable name
            'fk_id_asignatura', // Name
            '`fk_id_asignatura`', // Expression
            '`fk_id_asignatura`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`fk_id_asignatura`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->fk_id_asignatura->InputTextType = "text";
        $this->fk_id_asignatura->IsForeignKey = true; // Foreign key field
        $this->fk_id_asignatura->Nullable = false; // NOT NULL field
        $this->fk_id_asignatura->Required = true; // Required field
        $this->fk_id_asignatura->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->fk_id_asignatura->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en-US":
                $this->fk_id_asignatura->Lookup = new Lookup('fk_id_asignatura', 'asignatura_tbl', false, 'id_asignatura', ["nombre_asignatura","","",""], '', '', [], ["x_fk_id_alumno"], [], [], [], [], '`nombre_asignatura`', '', "`nombre_asignatura`");
                break;
            default:
                $this->fk_id_asignatura->Lookup = new Lookup('fk_id_asignatura', 'asignatura_tbl', false, 'id_asignatura', ["nombre_asignatura","","",""], '', '', [], ["x_fk_id_alumno"], [], [], [], [], '`nombre_asignatura`', '', "`nombre_asignatura`");
                break;
        }
        $this->fk_id_asignatura->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->fk_id_asignatura->SearchOperators = ["=", "<>", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['fk_id_asignatura'] = &$this->fk_id_asignatura;

        // fk_id_alumno
        $this->fk_id_alumno = new DbField(
            $this, // Table
            'x_fk_id_alumno', // Variable name
            'fk_id_alumno', // Name
            '`fk_id_alumno`', // Expression
            '`fk_id_alumno`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`fk_id_alumno`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->fk_id_alumno->InputTextType = "text";
        $this->fk_id_alumno->IsForeignKey = true; // Foreign key field
        $this->fk_id_alumno->Nullable = false; // NOT NULL field
        $this->fk_id_alumno->Required = true; // Required field
        $this->fk_id_alumno->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->fk_id_alumno->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en-US":
                $this->fk_id_alumno->Lookup = new Lookup('fk_id_alumno', 'alumnosporasigntura_vw', false, 'id_alumno', ["nombre_alumno","apellidos_alumno","numcarnet_alumno",""], '', '', ["x_fk_id_asignatura"], [], ["fk_id_asignatura"], ["x_fk_id_asignatura"], [], [], '', '', "CONCAT(COALESCE(`nombre_alumno`, ''),'" . ValueSeparator(1, $this->fk_id_alumno) . "',COALESCE(`apellidos_alumno`,''),'" . ValueSeparator(2, $this->fk_id_alumno) . "',COALESCE(`numcarnet_alumno`,''))");
                break;
            default:
                $this->fk_id_alumno->Lookup = new Lookup('fk_id_alumno', 'alumnosporasigntura_vw', false, 'id_alumno', ["nombre_alumno","apellidos_alumno","numcarnet_alumno",""], '', '', ["x_fk_id_asignatura"], [], ["fk_id_asignatura"], ["x_fk_id_asignatura"], [], [], '', '', "CONCAT(COALESCE(`nombre_alumno`, ''),'" . ValueSeparator(1, $this->fk_id_alumno) . "',COALESCE(`apellidos_alumno`,''),'" . ValueSeparator(2, $this->fk_id_alumno) . "',COALESCE(`numcarnet_alumno`,''))");
                break;
        }
        $this->fk_id_alumno->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->fk_id_alumno->SearchOperators = ["=", "<>", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['fk_id_alumno'] = &$this->fk_id_alumno;

        // nota_calificacion
        $this->nota_calificacion = new DbField(
            $this, // Table
            'x_nota_calificacion', // Variable name
            'nota_calificacion', // Name
            '`nota_calificacion`', // Expression
            '`nota_calificacion`', // Basic search expression
            200, // Type
            3, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`nota_calificacion`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->nota_calificacion->InputTextType = "text";
        $this->nota_calificacion->Nullable = false; // NOT NULL field
        $this->nota_calificacion->Required = true; // Required field
        $this->nota_calificacion->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['nota_calificacion'] = &$this->nota_calificacion;

        // observacion_calificacion
        $this->observacion_calificacion = new DbField(
            $this, // Table
            'x_observacion_calificacion', // Variable name
            'observacion_calificacion', // Name
            '`observacion_calificacion`', // Expression
            '`observacion_calificacion`', // Basic search expression
            200, // Type
            100, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`observacion_calificacion`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXTAREA' // Edit Tag
        );
        $this->observacion_calificacion->InputTextType = "text";
        $this->observacion_calificacion->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY", "IS NULL", "IS NOT NULL"];
        $this->Fields['observacion_calificacion'] = &$this->observacion_calificacion;

        // fk_id_evaluacion
        $this->fk_id_evaluacion = new DbField(
            $this, // Table
            'x_fk_id_evaluacion', // Variable name
            'fk_id_evaluacion', // Name
            '`fk_id_evaluacion`', // Expression
            '`fk_id_evaluacion`', // Basic search expression
            3, // Type
            11, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`fk_id_evaluacion`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->fk_id_evaluacion->InputTextType = "text";
        $this->fk_id_evaluacion->Nullable = false; // NOT NULL field
        $this->fk_id_evaluacion->Required = true; // Required field
        $this->fk_id_evaluacion->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->fk_id_evaluacion->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en-US":
                $this->fk_id_evaluacion->Lookup = new Lookup('fk_id_evaluacion', 'evaluacion_tbl', false, 'id_evaluacion', ["nombre_evaluacion","","",""], '', '', [], [], [], [], [], [], '`nombre_evaluacion`', '', "`nombre_evaluacion`");
                break;
            default:
                $this->fk_id_evaluacion->Lookup = new Lookup('fk_id_evaluacion', 'evaluacion_tbl', false, 'id_evaluacion', ["nombre_evaluacion","","",""], '', '', [], [], [], [], [], [], '`nombre_evaluacion`', '', "`nombre_evaluacion`");
                break;
        }
        $this->fk_id_evaluacion->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->fk_id_evaluacion->SearchOperators = ["=", "<>", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['fk_id_evaluacion'] = &$this->fk_id_evaluacion;

        // Add Doctrine Cache
        $this->Cache = new ArrayCache();
        $this->CacheProfile = new \Doctrine\DBAL\Cache\QueryCacheProfile(0, $this->TableVar);

        // Call Table Load event
        $this->tableLoad();
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        }
    }

    // Update field sort
    public function updateFieldSort()
    {
        $orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
        $flds = GetSortFields($orderBy);
        foreach ($this->Fields as $field) {
            $fldSort = "";
            foreach ($flds as $fld) {
                if ($fld[0] == $field->Expression || $fld[0] == $field->VirtualExpression) {
                    $fldSort = $fld[1];
                }
            }
            $field->setSort($fldSort);
        }
    }

    // Current master table name
    public function getCurrentMasterTable()
    {
        return Session(PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE"));
    }

    public function setCurrentMasterTable($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")] = $v;
    }

    // Get master WHERE clause from session values
    public function getMasterFilterFromSession()
    {
        // Master filter
        $masterFilter = "";
        if ($this->getCurrentMasterTable() == "alumnotbl") {
            $masterTable = Container("alumnotbl");
            if ($this->fk_id_alumno->getSessionValue() != "") {
                $masterFilter .= "" . GetKeyFilter($masterTable->id_alumno, $this->fk_id_alumno->getSessionValue(), $masterTable->id_alumno->DataType, $masterTable->Dbid);
            } else {
                return "";
            }
        }
        if ($this->getCurrentMasterTable() == "asignatura_tbl") {
            $masterTable = Container("asignatura_tbl");
            if ($this->fk_id_asignatura->getSessionValue() != "") {
                $masterFilter .= "" . GetKeyFilter($masterTable->id_asignatura, $this->fk_id_asignatura->getSessionValue(), $masterTable->id_asignatura->DataType, $masterTable->Dbid);
            } else {
                return "";
            }
        }
        return $masterFilter;
    }

    // Get detail WHERE clause from session values
    public function getDetailFilterFromSession()
    {
        // Detail filter
        $detailFilter = "";
        if ($this->getCurrentMasterTable() == "alumnotbl") {
            $masterTable = Container("alumnotbl");
            if ($this->fk_id_alumno->getSessionValue() != "") {
                $detailFilter .= "" . GetKeyFilter($this->fk_id_alumno, $this->fk_id_alumno->getSessionValue(), $masterTable->id_alumno->DataType, $this->Dbid);
            } else {
                return "";
            }
        }
        if ($this->getCurrentMasterTable() == "asignatura_tbl") {
            $masterTable = Container("asignatura_tbl");
            if ($this->fk_id_asignatura->getSessionValue() != "") {
                $detailFilter .= "" . GetKeyFilter($this->fk_id_asignatura, $this->fk_id_asignatura->getSessionValue(), $masterTable->id_asignatura->DataType, $this->Dbid);
            } else {
                return "";
            }
        }
        return $detailFilter;
    }

    /**
     * Get master filter
     *
     * @param object $masterTable Master Table
     * @param array $keys Detail Keys
     * @return mixed NULL is returned if all keys are empty, Empty string is returned if some keys are empty and is required
     */
    public function getMasterFilter($masterTable, $keys)
    {
        $validKeys = true;
        switch ($masterTable->TableVar) {
            case "alumnotbl":
                $key = $keys["fk_id_alumno"] ?? "";
                if (EmptyValue($key)) {
                    if ($masterTable->id_alumno->Required) { // Required field and empty value
                        return ""; // Return empty filter
                    }
                    $validKeys = false;
                } elseif (!$validKeys) { // Already has empty key
                    return ""; // Return empty filter
                }
                if ($validKeys) {
                    return GetKeyFilter($masterTable->id_alumno, $keys["fk_id_alumno"], $this->fk_id_alumno->DataType, $this->Dbid);
                }
                break;
            case "asignatura_tbl":
                $key = $keys["fk_id_asignatura"] ?? "";
                if (EmptyValue($key)) {
                    if ($masterTable->id_asignatura->Required) { // Required field and empty value
                        return ""; // Return empty filter
                    }
                    $validKeys = false;
                } elseif (!$validKeys) { // Already has empty key
                    return ""; // Return empty filter
                }
                if ($validKeys) {
                    return GetKeyFilter($masterTable->id_asignatura, $keys["fk_id_asignatura"], $this->fk_id_asignatura->DataType, $this->Dbid);
                }
                break;
        }
        return null; // All null values and no required fields
    }

    // Get detail filter
    public function getDetailFilter($masterTable)
    {
        switch ($masterTable->TableVar) {
            case "alumnotbl":
                return GetKeyFilter($this->fk_id_alumno, $masterTable->id_alumno->DbValue, $masterTable->id_alumno->DataType, $masterTable->Dbid);
            case "asignatura_tbl":
                return GetKeyFilter($this->fk_id_asignatura, $masterTable->id_asignatura->DbValue, $masterTable->id_asignatura->DataType, $masterTable->Dbid);
        }
        return "";
    }

    // Render X Axis for chart
    public function renderChartXAxis($chartVar, $chartRow)
    {
        return $chartRow;
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`calificacion_tbl`";
    }

    public function sqlFrom() // For backward compatibility
    {
        return $this->getSqlFrom();
    }

    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*");
    }

    public function sqlSelect() // For backward compatibility
    {
        return $this->getSqlSelect();
    }

    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    public function getSqlWhere() // Where
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    public function sqlWhere() // For backward compatibility
    {
        return $this->getSqlWhere();
    }

    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    public function getSqlGroupBy() // Group By
    {
        return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
    }

    public function sqlGroupBy() // For backward compatibility
    {
        return $this->getSqlGroupBy();
    }

    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    public function sqlHaving() // For backward compatibility
    {
        return $this->getSqlHaving();
    }

    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    public function getSqlOrderBy() // Order By
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
    }

    public function sqlOrderBy() // For backward compatibility
    {
        return $this->getSqlOrderBy();
    }

    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter, $id = "")
    {
        global $Security;
        // Add User ID filter
        if ($Security->currentUserID() != "" && !$Security->isAdmin()) { // Non system admin
            if ($this->getCurrentMasterTable() == "alumnotbl" || $this->getCurrentMasterTable() == "") {
                $filter = $this->addDetailUserIDFilter($filter, "alumnotbl"); // Add detail User ID filter
            }
            if ($this->getCurrentMasterTable() == "asignatura_tbl" || $this->getCurrentMasterTable() == "") {
                $filter = $this->addDetailUserIDFilter($filter, "asignatura_tbl"); // Add detail User ID filter
            }
        }
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return (($allow & 1) == 1);
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return (($allow & 4) == 4);
            case "delete":
                return (($allow & 2) == 2);
            case "view":
                return (($allow & 32) == 32);
            case "search":
                return (($allow & 64) == 64);
            case "lookup":
                return (($allow & 256) == 256);
            default:
                return (($allow & 8) == 8);
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $rs = null;
        if ($sql instanceof QueryBuilder) { // Query builder
            $sqlwrk = clone $sql;
            $sqlwrk = $sqlwrk->resetQueryPart("orderBy")->getSQL();
        } else {
            $sqlwrk = $sql;
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sqlwrk) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sqlwrk) && !preg_match('/\s+order\s+by\s+/i', $sqlwrk)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $cnt = $conn->fetchOne($sqlwrk);
        if ($cnt !== false) {
            return (int)$cnt;
        }

        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        return ExecuteRecordCount($sql, $conn);
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->getSqlAsQueryBuilder($where, $orderBy)->getSQL();
    }

    // Get QueryBuilder
    public function getSqlAsQueryBuilder($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        );
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    public function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->setValue($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        try {
            $success = $this->insertSql($rs)->execute();
            $this->DbErrorMessage = "";
        } catch (\Exception $e) {
            $success = false;
            $this->DbErrorMessage = $e->getMessage();
        }
        if ($success) {
            // Get insert id if necessary
            $this->id_calificacion->setDbValue($conn->lastInsertId());
            $rs['id_calificacion'] = $this->id_calificacion->DbValue;
        }
        return $success;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->set($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        try {
            $success = $this->updateSql($rs, $where, $curfilter)->execute();
            $success = ($success > 0) ? $success : true;
            $this->DbErrorMessage = "";
        } catch (\Exception $e) {
            $success = false;
            $this->DbErrorMessage = $e->getMessage();
        }

        // Return auto increment field
        if ($success) {
            if (!isset($rs['id_calificacion']) && !EmptyValue($this->id_calificacion->CurrentValue)) {
                $rs['id_calificacion'] = $this->id_calificacion->CurrentValue;
            }
        }
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
            if (array_key_exists('id_calificacion', $rs)) {
                AddFilter($where, QuotedName('id_calificacion', $this->Dbid) . '=' . QuotedValue($rs['id_calificacion'], $this->id_calificacion->DataType, $this->Dbid));
            }
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            try {
                $success = $this->deleteSql($rs, $where, $curfilter)->execute();
                $this->DbErrorMessage = "";
            } catch (\Exception $e) {
                $success = false;
                $this->DbErrorMessage = $e->getMessage();
            }
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->id_calificacion->DbValue = $row['id_calificacion'];
        $this->fk_id_asignatura->DbValue = $row['fk_id_asignatura'];
        $this->fk_id_alumno->DbValue = $row['fk_id_alumno'];
        $this->nota_calificacion->DbValue = $row['nota_calificacion'];
        $this->observacion_calificacion->DbValue = $row['observacion_calificacion'];
        $this->fk_id_evaluacion->DbValue = $row['fk_id_evaluacion'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`id_calificacion` = @id_calificacion@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->id_calificacion->CurrentValue : $this->id_calificacion->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->id_calificacion->CurrentValue = $keys[0];
            } else {
                $this->id_calificacion->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null, $current = false)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id_calificacion', $row) ? $row['id_calificacion'] : null;
        } else {
            $val = !EmptyValue($this->id_calificacion->OldValue) && !$current ? $this->id_calificacion->OldValue : $this->id_calificacion->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id_calificacion@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("CalificacionTblList");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "CalificacionTblView") {
            return $Language->phrase("View");
        } elseif ($pageName == "CalificacionTblEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "CalificacionTblAdd") {
            return $Language->phrase("Add");
        }
        return "";
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "CalificacionTblView";
            case Config("API_ADD_ACTION"):
                return "CalificacionTblAdd";
            case Config("API_EDIT_ACTION"):
                return "CalificacionTblEdit";
            case Config("API_DELETE_ACTION"):
                return "CalificacionTblDelete";
            case Config("API_LIST_ACTION"):
                return "CalificacionTblList";
            default:
                return "";
        }
    }

    // Current URL
    public function getCurrentUrl($parm = "")
    {
        $url = CurrentPageUrl(false);
        if ($parm != "") {
            $url = $this->keyUrl($url, $parm);
        } else {
            $url = $this->keyUrl($url, Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // List URL
    public function getListUrl()
    {
        return "CalificacionTblList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("CalificacionTblView", $parm);
        } else {
            $url = $this->keyUrl("CalificacionTblView", Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "CalificacionTblAdd?" . $parm;
        } else {
            $url = "CalificacionTblAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("CalificacionTblEdit", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl("CalificacionTblList", "action=edit");
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("CalificacionTblAdd", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl("CalificacionTblList", "action=copy");
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        if ($this->UseAjaxActions && ConvertToBool(Param("infinitescroll")) && CurrentPageID() == "list") {
            return $this->keyUrl(GetApiUrl(Config("API_DELETE_ACTION") . "/" . $this->TableVar));
        } else {
            return $this->keyUrl("CalificacionTblDelete");
        }
    }

    // Add master url
    public function addMasterUrl($url)
    {
        if ($this->getCurrentMasterTable() == "alumnotbl" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
            $url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
            $url .= "&" . GetForeignKeyUrl("fk_id_alumno", $this->fk_id_alumno->getSessionValue()); // Use Session Value
        }
        if ($this->getCurrentMasterTable() == "asignatura_tbl" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
            $url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
            $url .= "&" . GetForeignKeyUrl("fk_id_asignatura", $this->fk_id_asignatura->getSessionValue()); // Use Session Value
        }
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"id_calificacion\":" . JsonEncode($this->id_calificacion->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id_calificacion->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->id_calificacion->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderFieldHeader($fld)
    {
        global $Security, $Language, $Page;
        $sortUrl = "";
        $attrs = "";
        if ($fld->Sortable) {
            $sortUrl = $this->sortUrl($fld);
            $attrs = ' role="button" data-ew-action="sort" data-ajax="' . ($this->UseAjaxActions ? "true" : "false") . '" data-sort-url="' . $sortUrl . '" data-sort-type="1"';
            if ($this->ContextClass) { // Add context
                $attrs .= ' data-context="' . HtmlEncode($this->ContextClass) . '"';
            }
        }
        $html = '<div class="ew-table-header-caption"' . $attrs . '>' . $fld->caption() . '</div>';
        if ($sortUrl) {
            $html .= '<div class="ew-table-header-sort">' . $fld->getSortIcon() . '</div>';
        }
        if ($fld->UseFilter && $Security->canSearch()) {
            $html .= '<div class="ew-filter-dropdown-btn" data-ew-action="filter" data-table="' . $fld->TableVar . '" data-field="' . $fld->FieldVar .
                '"><div class="ew-table-header-filter" role="button" aria-haspopup="true">' . $Language->phrase("Filter") . '</div></div>';
        }
        $html = '<div class="ew-table-header-btn">' . $html . '</div>';
        if ($this->UseCustomTemplate) {
            $scriptId = str_replace("{id}", $fld->TableVar . "_" . $fld->Param, "tpc_{id}");
            $html = '<template id="' . $scriptId . '">' . $html . '</template>';
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        global $DashboardReport;
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = "order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort();
            if ($DashboardReport) {
                $urlParm .= "&amp;dashboard=true";
            }
            return $this->addMasterUrl($this->CurrentPageName . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            if (($keyValue = Param("id_calificacion") ?? Route("id_calificacion")) !== null) {
                $arKeys[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_numeric($key)) {
                    continue;
                }
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from records
    public function getFilterFromRecords($rows)
    {
        $keyFilter = "";
        foreach ($rows as $row) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            $keyFilter .= "(" . $this->getRecordFilter($row) . ")";
        }
        return $keyFilter;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            if ($setCurrent) {
                $this->id_calificacion->CurrentValue = $key;
            } else {
                $this->id_calificacion->OldValue = $key;
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load recordset based on filter
    public function loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        return $conn->executeQuery($sql);
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
        $this->id_calificacion->setDbValue($row['id_calificacion']);
        $this->fk_id_asignatura->setDbValue($row['fk_id_asignatura']);
        $this->fk_id_alumno->setDbValue($row['fk_id_alumno']);
        $this->nota_calificacion->setDbValue($row['nota_calificacion']);
        $this->observacion_calificacion->setDbValue($row['observacion_calificacion']);
        $this->fk_id_evaluacion->setDbValue($row['fk_id_evaluacion']);
    }

    // Render list content
    public function renderListContent($filter)
    {
        global $Response;
        $listPage = "CalificacionTblList";
        $listClass = PROJECT_NAMESPACE . $listPage;
        $page = new $listClass();
        $page->loadRecordsetFromFilter($filter);
        $view = Container("view");
        $template = $listPage . ".php"; // View
        $GLOBALS["Title"] ??= $page->Title; // Title
        try {
            $Response = $view->render($Response, $template, $GLOBALS);
        } finally {
            $page->terminate(); // Terminate page and clean up
        }
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id_calificacion
        $this->id_calificacion->CellCssStyle = "white-space: nowrap;";

        // fk_id_asignatura

        // fk_id_alumno

        // nota_calificacion

        // observacion_calificacion

        // fk_id_evaluacion

        // id_calificacion
        $this->id_calificacion->ViewValue = $this->id_calificacion->CurrentValue;

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

        // id_calificacion
        $this->id_calificacion->HrefValue = "";
        $this->id_calificacion->TooltipValue = "";

        // fk_id_asignatura
        $this->fk_id_asignatura->HrefValue = "";
        $this->fk_id_asignatura->TooltipValue = "";

        // fk_id_alumno
        $this->fk_id_alumno->HrefValue = "";
        $this->fk_id_alumno->TooltipValue = "";

        // nota_calificacion
        $this->nota_calificacion->HrefValue = "";
        $this->nota_calificacion->TooltipValue = "";

        // observacion_calificacion
        $this->observacion_calificacion->HrefValue = "";
        $this->observacion_calificacion->TooltipValue = "";

        // fk_id_evaluacion
        $this->fk_id_evaluacion->HrefValue = "";
        $this->fk_id_evaluacion->TooltipValue = "";

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // id_calificacion
        $this->id_calificacion->setupEditAttributes();
        $this->id_calificacion->EditValue = $this->id_calificacion->CurrentValue;

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
            $this->fk_id_asignatura->PlaceHolder = RemoveHtml($this->fk_id_asignatura->caption());
        }

        // fk_id_alumno
        $this->fk_id_alumno->setupEditAttributes();
        if ($this->fk_id_alumno->getSessionValue() != "") {
            $this->fk_id_alumno->CurrentValue = GetForeignKeyValue($this->fk_id_alumno->getSessionValue());
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
        } else {
            $this->fk_id_alumno->PlaceHolder = RemoveHtml($this->fk_id_alumno->caption());
        }

        // nota_calificacion
        $this->nota_calificacion->setupEditAttributes();
        if (!$this->nota_calificacion->Raw) {
            $this->nota_calificacion->CurrentValue = HtmlDecode($this->nota_calificacion->CurrentValue);
        }
        $this->nota_calificacion->EditValue = $this->nota_calificacion->CurrentValue;
        $this->nota_calificacion->PlaceHolder = RemoveHtml($this->nota_calificacion->caption());

        // observacion_calificacion
        $this->observacion_calificacion->setupEditAttributes();
        $this->observacion_calificacion->EditValue = $this->observacion_calificacion->CurrentValue;
        $this->observacion_calificacion->PlaceHolder = RemoveHtml($this->observacion_calificacion->caption());

        // fk_id_evaluacion
        $this->fk_id_evaluacion->setupEditAttributes();
        $this->fk_id_evaluacion->PlaceHolder = RemoveHtml($this->fk_id_evaluacion->caption());

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$recordset || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->fk_id_asignatura);
                    $doc->exportCaption($this->fk_id_alumno);
                    $doc->exportCaption($this->nota_calificacion);
                    $doc->exportCaption($this->observacion_calificacion);
                    $doc->exportCaption($this->fk_id_evaluacion);
                } else {
                    $doc->exportCaption($this->fk_id_asignatura);
                    $doc->exportCaption($this->fk_id_alumno);
                    $doc->exportCaption($this->nota_calificacion);
                    $doc->exportCaption($this->observacion_calificacion);
                    $doc->exportCaption($this->fk_id_evaluacion);
                }
                $doc->endExportRow();
            }
        }

        // Move to first record
        $recCnt = $startRec - 1;
        $stopRec = ($stopRec > 0) ? $stopRec : PHP_INT_MAX;
        while (!$recordset->EOF && $recCnt < $stopRec) {
            $row = $recordset->fields;
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = ROWTYPE_VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->fk_id_asignatura);
                        $doc->exportField($this->fk_id_alumno);
                        $doc->exportField($this->nota_calificacion);
                        $doc->exportField($this->observacion_calificacion);
                        $doc->exportField($this->fk_id_evaluacion);
                    } else {
                        $doc->exportField($this->fk_id_asignatura);
                        $doc->exportField($this->fk_id_alumno);
                        $doc->exportField($this->nota_calificacion);
                        $doc->exportField($this->observacion_calificacion);
                        $doc->exportField($this->fk_id_evaluacion);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($doc, $row);
            }
            $recordset->moveNext();
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Add master User ID filter
    public function addMasterUserIDFilter($filter, $currentMasterTable)
    {
        $filterWrk = $filter;
        if ($currentMasterTable == "asignatura_tbl") {
            $filterWrk = Container("asignatura_tbl")->addUserIDFilter($filterWrk);
        }
        return $filterWrk;
    }

    // Add detail User ID filter
    public function addDetailUserIDFilter($filter, $currentMasterTable)
    {
        $filterWrk = $filter;
        if ($currentMasterTable == "asignatura_tbl") {
            $mastertable = Container("asignatura_tbl");
            if (!$mastertable->userIDAllow()) {
                $subqueryWrk = $mastertable->getUserIDSubquery($this->fk_id_asignatura, $mastertable->id_asignatura);
                AddFilter($filterWrk, $subqueryWrk);
            }
        }
        return $filterWrk;
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        global $DownloadFileName;

        // No binary fields
        return false;
    }

    // Table level events

    // Table Load event
    public function tableLoad()
    {
        // Enter your code here
    }

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected(&$rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
    /* $AlumnoCursaMateria = ExecuteScalar("SELECT count(*) FROM alumnos_asignatura_tbl WHERE fk_id_alumno=$rsnew[fk_id_alumno] AND fk_id_asignatura=$rsnew[fk_id_asignatura]");
        if($AlumnoCursaMateria>0){
            return true;
        }
        else
        {
            $this->CancelMessage = "El alumno no cursa esa materia actualmente";
            return false; 
        }  */
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted(&$rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email, $args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
