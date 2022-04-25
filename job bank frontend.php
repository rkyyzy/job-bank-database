<!--Test Oracle file for UBC CPSC304 2018 Winter Term 1
  Created by Jiemin Zhang
  Modified by Simona Radu
  Modified by Jessica Wong (2018-06-22)
  Modified by CPSC 304 Group 99 (2021)-->

  <html>
    <head>
        <title>CPSC 304 PROJECT</title>
    </head>

    <body>
        <h2>Insert</h2>
        <h3>Insert values into Employer</h3>
        <form method="POST" action="milestone4.php">
            <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
            Employer ID: <input type="text" name="insNo"> <br /><br />
            Name: <input type="text" name="insName"> <br /><br />
            Address: <input type="text" name="insAdd"> <br /><br />
            StudyField or IndustryType: <input type="text" name="insType"> <br /><br />
            Choose a Employer Type:
            <select name="select_Employer" id="select_Employer">
            <option value="ResearchInstitute">ResearchInstitute</option>
            <option value="Enterprise">Enterprise</option>
            </select>
            <input type="submit" value="Insert" name="insertSubmit"></p>
        </form>

        <hr />

        <h2>Delete</h2>
        <h3>Delete specific tuple in Employer</h3>
        <form method="POST" action="milestone4.php">
            <input type="hidden" id="deleteQueryRequest" name="deleteQueryRequest">
            Employer ID: <input type="text" name="deleInsNo"> <br /><br />
            <input type="submit" value="Delete" name="deleteSubmit"></p>
        </form>
        <hr />

        <h2>Update</h2>
        <h3>Update Name, Address in Employer</h3>
        <p>The values are case sensitive and if you enter in the wrong case, the update statement will not do anything.</p>
        <form method="POST" action="milestone4.php"> 
            <input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
            Employer ID: <input type="text" name="empID"> <br /><br />
            Name: <input type="text" name="newName"> <br /><br />
            Address: <input type="text" name="newAddress"> <br /><br />

            <input type="submit" value="Update" name="updateSubmit"></p>
        </form>
        <hr />

        <h2>Selection</h2>
        <h3>Display the Job posted by Employer, search by Employer ID or Name</h3>
        <form method="POST" action="milestone4.php">
            <input type="hidden" id="displayJobRequest" name="displayJobRequest">
            Search by:
            <select name="select_Type" id="select_Type">
            <option value="ID">Employer ID</option>
            <option value="Name">Employer Name</option>
            </select>
            <input type="text" name="inputType"> <br /><br />

            <input type="submit" value="Display" name="displayJobSubmit"></p>
        </form>
        <hr />

        <h2>Projection</h2>
        <h3>Display Job information</h3>
        <form method="POST" action="milestone4.php">
            <input type="hidden" id="displayJobInfoRequest" name="displayJobInfoRequest">
            <input type="checkbox" id="ck_1" name="ck_1" value="ck_name">
            <label for="vehicle1"> NAME</label><br>
            <input type="checkbox" id="ck_2" name="ck_2" value="ck_req">
            <label for="vehicle2"> REQUIREMENT</label><br>
            <input type="checkbox" id="ck_3" name="ck_3" value="ck_time">
            <label for="vehicle3"> TIME LENGTH</label><br><br>
            <input type="submit" value="Display" name="displayJobInfoSubmit"></p>
        </form>
        <hr />

        <h2>Join</h2>
        <h3>Display Employer by Job posted with key word</h3>
        <form method="POST" action="milestone4.php">
            <input type="hidden" id="displayEmpInfoRequest" name="displayEmpInfoRequest">
            Job key word: <input type="text" name="keyWord"> <br /><br />

            <input type="submit" value="Search" name="displayEmpInfoSubmit"></p>
        </form>
        <hr />

        <h2>Aggregation with Group By</h2>
        <h3>Find the max time length of the jobs that is more than 3 month for each requirement</h3>
        <form method="GET" action="milestone4.php">
            <input type="hidden" id="displayAggGroupBy" name="displayAggGroupBy">
            <input type="submit" value="Display" name="displayAggGroupBySubmit"></p>
        </form>
        <hr />

        <h2>Nested Aggregation with Group By</h2>
        <h3>Find IDs and Names of each job which is posted in 2021 whose time length is more than 3 months</h3>
        <form method="GET" action="milestone4.php">
            <input type="hidden" id="displayNestAggGroupBy" name="displayNestAggGroupBy">
            <input type="submit" value="Display" name="displayNestAggGroupBySubmit"></p>
        </form>
        <hr />

        <h2>Aggregation with Having</h2>
        <h3>Find the max time length of the jobs that is more than 3 months for each requirement with at least 2 such job</h3>
        <form method="GET" action="milestone4.php">
            <input type="hidden" id="displayAggHaving" name="displayAggHaving">
            <input type="submit" value="Display" name="displayAggHavingSubmit"></p>
        </form>
        <hr />

        <h2>Division</h2>
        <h3>Find job seekers who have attended all job training</h3>
        <form method="GET" action="milestone4.php">
            <input type="hidden" id="displayDivision" name="displayDivision">
            <input type="submit" value="Display" name="displayDivisionSubmit"></p>
        </form>
        <hr />

        <h2>Display</h2>
        <h3>Display the Tuples in Employer and its child tables</h3>
        <form method="GET" action="milestone4.php">
            <input type="hidden" id="displayTupleRequest" name="displayTupleRequest">
            <input type="submit" value="Display" name="displayTuples"></p>
        </form>

        <?php
		//this tells the system that it's no longer just parsing html; it's now parsing PHP

        $success = True; //keep track of errors so it redirects the page only if there are no errors
        $db_conn = NULL; // edit the login credentials in connectToDB()
        $show_debug_alert_messages = False; // set to True if you want alerts to show you which methods are being triggered (see how it is used in debugAlertMessage())

        function debugAlertMessage($message) {
            global $show_debug_alert_messages;

            if ($show_debug_alert_messages) {
                echo "<script type='text/javascript'>alert('" . $message . "');</script>";
            }
        }

        function executePlainSQL($cmdstr) { //takes a plain (no bound variables) SQL command and executes it
            //echo "<br>running ".$cmdstr."<br>";
            global $db_conn, $success;

            $statement = OCIParse($db_conn, $cmdstr); 
            //There are a set of comments at the end of the file that describe some of the OCI specific functions and how they work

            if (!$statement) {
                echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
                $e = OCI_Error($db_conn); // For OCIParse errors pass the connection handle
                echo htmlentities($e['message']);
                $success = False;
            }

            $r = OCIExecute($statement, OCI_DEFAULT);
            if (!$r) {
                echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
                $e = oci_error($statement); // For OCIExecute errors pass the statementhandle
                echo htmlentities($e['message']);
                $success = False;
            }

			return $statement;
		}

        function executeBoundSQL($cmdstr, $list) {
            /* Sometimes the same statement will be executed several times with different values for the variables involved in the query.
		In this case you don't need to create the statement several times. Bound variables cause a statement to only be
		parsed once and you can reuse the statement. This is also very useful in protecting against SQL injection. 
		See the sample code below for how this function is used */

			global $db_conn, $success;
			$statement = OCIParse($db_conn, $cmdstr);

            if (!$statement) {
                echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
                $e = OCI_Error($db_conn);
                echo htmlentities($e['message']);
                $success = False;
            }

            foreach ($list as $tuple) {
                foreach ($tuple as $bind => $val) {
                    //echo $val;
                    //echo "<br>".$bind."<br>";
                    OCIBindByName($statement, $bind, $val);
                    unset ($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype
				}

                $r = OCIExecute($statement, OCI_DEFAULT);
                if (!$r) {
                    echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
                    $e = OCI_Error($statement); // For OCIExecute errors, pass the statementhandle
                    echo htmlentities($e['message']);
                    echo "<br>";
                    $success = False;
                }
            }
        }

        function printEmployerResult($result) { 
            echo "<br>Retrieved data from table Employer:<br>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>Address</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["NAME"] . "</td><td>" . $row["ADDRESS"] . "</td></tr>";
            }

            echo "</table>";
        }

        function printReseachResult($result) { 
            echo "<br>Retrieved data from table Research Institute:<br>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Study Field</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row["EMPLOYERID"] . "</td><td>" . $row["STUDYFIELD"] . "</td></tr>";
            }

            echo "</table>";
        }

        function printEnterpriseResult($result) { 
            echo "<br>Retrieved data from table Enterprise:<br>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Industry Type</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row["EMPLOYERID"] . "</td><td>" . $row["INDUSTRYTYPE"] . "</td></tr>";
            }

            echo "</table>";
        }

        function printJobResult($result) { 
            echo "<br>Filtered Job by Employer(ID or Name):<br>";
            echo "<table>";
            echo "<tr><th>Job Name</th><th>Job Requirement</th><th>Time length (months)</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row["NAME"] . "</td><td>" . $row["REQUIREMENT"] . "</td><td>" . $row["TIMELENGTH"] . "</td></tr>"; 
            }

            echo "</table>";
        }

        function connectToDB() {
            global $db_conn;

            // Your username is ora_(CWL_ID) and the password is a(student number). For example, 
			// ora_platypus is the username and a12345678 is the password.
            $db_conn = OCILogon("ora_yzy98", "a95364667", "dbhost.students.cs.ubc.ca:1522/stu");

            if ($db_conn) {
                debugAlertMessage("Database is Connected");
                return true;
            } else {
                debugAlertMessage("Cannot connect to Database");
                $e = OCI_Error(); // For OCILogon errors pass no handle
                echo htmlentities($e['message']);
                return false;
            }
        }

        function disconnectFromDB() {
            global $db_conn;

            debugAlertMessage("Disconnect from Database");
            OCILogoff($db_conn);
        }

        function handleUpdateRequest() {
            global $db_conn;

            $empID = $_POST['empID'];
            $new_name = $_POST['newName'];
            $new_add = $_POST['newAddress'];

            // you need the wrap the old name and new name values with single quotations
            executePlainSQL("UPDATE Employer SET Name='" . $new_name . "', Address='" . $new_add . "' WHERE ID='" . $empID . "'");
            OCICommit($db_conn);
        }

        function handleResetRequest() {
            global $db_conn;
            // Drop old table
            executePlainSQL("DROP TABLE demoTable");

            // Create new table
            echo "<br> creating new table <br>";
            executePlainSQL("CREATE TABLE demoTable (id int PRIMARY KEY, name char(30))");
            OCICommit($db_conn);
        }

        function handleInsertRequest() {
            global $db_conn;

            //Getting the values from user and insert data into the table
            $tuple = array (
                ":bind1" => $_POST['insNo'],
                ":bind2" => $_POST['insName'],
                ":bind3" => $_POST['insAdd']
            );

            $tuple2 = array (
                ":bind1" => $_POST['insNo'],
                ":bind2" => $_POST['insType']
            );


            $alltuples = array (
                $tuple
            );

            $alltuples2 = array (
                $tuple2
            );

            executeBoundSQL("insert into Employer values (:bind1, :bind2, :bind3)", $alltuples);
            
            if ($_POST['select_Employer'] == "ResearchInstitute") {
                executeBoundSQL("insert into ResearchInstitute values (:bind1, :bind2)", $alltuples2);
            } elseif (($_POST['select_Employer'] == "Enterprise")) {
                executeBoundSQL("insert into Enterprise values (:bind1, :bind2)", $alltuples2);
            }
            OCICommit($db_conn);
        }

        function handleDeleteRequest() {
            global $db_conn;

            //Getting the values from user and delete data into the table
            $delInsNo = $_POST['deleInsNo'];

            executePlainSQL("DELETE FROM Employer WHERE ID = '" . $delInsNo .  "'");
            OCICommit($db_conn);
        }

        function handleJobDisplayRequest() {
            global $db_conn;
            $typeValue = $_POST['inputType'];
            if ($_POST['select_Type'] == "ID") {
                $result = executePlainSQL("SELECT j.Name, j.Requirement, j.TimeLength 
                FROM Employer e, Post p, Job j 
                WHERE e.ID = p.EmployerID AND p.JobID = j.ID AND e.ID = '" . $typeValue . "'");
                printJobResult($result);
            } elseif ($_POST['select_Type'] == "Name") {
                $result = executePlainSQL("SELECT j.Name, j.Requirement, j.TimeLength 
                FROM Employer e, Post p, Job j 
                WHERE e.ID = p.EmployerID AND p.JobID = j.ID AND e.Name = '" . $typeValue . "'");
                printJobResult($result);
            }   
        }

        function handleEmpInfoDisplayRequest() {
            global $db_conn;
            $keyWord = "%" . $_POST['keyWord'] . "%";
            $result = executePlainSQL("SELECT DISTINCT e.id, e.Name FROM Employer e, Post p, Job j WHERE e.ID = p.EmployerID AND p.JobID = j.ID AND j.Name LIKE '" . $keyWord . "'");
            echo "<br>Filtered Employer By Job Posted (key word)<br>";
            echo "<table>";
            echo "<tr><th>ID</th><th>NAME</th></tr>";
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["NAME"] . "</td></tr>";
            }
            echo "</table>";
        }


        function handleCountRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT Count(*) FROM demoTable");

            if (($row = oci_fetch_row($result)) != false) {
                echo "<br> The number of tuples in demoTable: " . $row[0] . "<br>";
            }
        }

        function handleDisplayRequest() {
            global $db_conn;
            $result = executePlainSQL("SELECT * FROM Employer");
            printEmployerResult($result);
            $result = executePlainSQL("SELECT * FROM ResearchInstitute");
            printReseachResult($result);
            $result = executePlainSQL("SELECT * FROM Enterprise");
            printEnterpriseResult($result);
        }

        function handleAggGroupByRequest() {
            global $db_conn;
            $result = executePlainSQL("SELECT DISTINCT Requirement, MAX(j.TimeLength) FROM Job j WHERE j.TimeLength > 3 GROUP BY Requirement");
            echo "<br>Job with max time length that is more than 3 month long for each Requirement<br>";
            echo "<table>";
            echo "<tr><th>Job Requirement</th><th>Job Length (months)</th></tr>";
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row["REQUIREMENT"] . "</td><td>" . $row["MAX(J.TIMELENGTH)"] . "</td></tr>"; 
            }
            echo "</table>";
        }

        function handleNestAggGroupByRequest() {
            global $db_conn;
            $year = "%2021%";
            $result = executePlainSQL("SELECT DISTINCT j.Name, j.TimeLength FROM Job j WHERE j.TimeLength > 3 AND j.ID IN (SELECT p.JobID FROM Post p WHERE p.Dates LIKE '" . $year . "')");
            echo "<br>Job Name and time length that is posted in 2021 and time length is more than 3 months<br>";
            echo "<table>";
            echo "<tr><th>Job Name</th><th>Job Time length (months) </th></tr>";
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row["NAME"] . "</td><td>" . $row["TIMELENGTH"] . "</td></tr>"; 
            }
            echo "</table>";
        }

        function handleAggHavingRequest() {
            global $db_conn;
            $year = "%2021%";
            $result = executePlainSQL("SELECT DISTINCT Requirement, MAX(j.TimeLength) FROM Job j WHERE j.TimeLength > 3 GROUP BY Requirement HAVING COUNT(*) > 1");
            echo "<br>The max time length of the jobs that is more than 3 months for each requirement with at least 2 such jobs<br>";
            echo "<table>";
            echo "<tr><th>Job Requirement</th><th>Job Length (months)</th></tr>";
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row["REQUIREMENT"] . "</td><td>" . $row["MAX(J.TIMELENGTH)"] . "</td></tr>"; 
            }
            echo "</table>";
        }

        function handleDivisionRequest() {
            global $db_conn;
            $result = executePlainSQL("SELECT DISTINCT js.ID 
            FROM JobSeeker2 js
            WHERE NOT EXISTS ((SELECT jt.ID 
            FROM JobTraining jt) 
            MINUS (SELECT t.JobTrainingID 
            FROM JTargetJ t 
            WHERE t.JobSeekerID = js.ID))");
            echo "<br>Job seeker ID who have attended all job training<br>";
            echo "<table>";
            echo "<tr><th>Job ID</th></tr>";
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row["ID"] . "</td></tr>"; 
            }
            echo "</table>";
        }

        function handleJobInfoDisplayRequest() {
            global $db_conn;
            
            if ($_POST['ck_1'] == 'ck_name' && $_POST['ck_2'] == 'ck_req' && $_POST['ck_3'] == 'ck_time') {
                //name req time
                $result = executePlainSQL("SELECT Name, Requirement, TimeLength FROM Job");
                echo "<br>All distinct Job information by Name, Requirement, Time length<br>";
                echo "<table>";
                echo "<tr><th>Job Name</th><th>Job Requirement</th><th>Time length (months)</th></tr>";
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr><td>" . $row["NAME"] . "</td><td>" . $row["REQUIREMENT"] . "</td><td>" . $row["TIMELENGTH"] . "</td></tr>"; 
                }
                echo "</table>";
            } else if ($_POST['ck_1'] == 'ck_name' && $_POST['ck_2'] != 'ck_req' && $_POST['ck_3'] != 'ck_time') {
                //name
                $result = executePlainSQL("SELECT Name FROM Job");
                echo "<br>All distinct Job information by Name<br>";
                echo "<table>";
                echo "<tr><th>Job Name</th></tr>";
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr><td>" . $row["NAME"] . "</td></tr>"; 
                }
                echo "</table>";
            } else if ($_POST['ck_1'] != 'ck_name' && $_POST['ck_2'] == 'ck_req' && $_POST['ck_3'] != 'ck_time') {
                //req
                $result = executePlainSQL("SELECT Requirement FROM Job");
                echo "<br>All distinct Job information by Requirement<br>";
                echo "<table>";
                echo "<tr><th>Job Requirement</th></tr>";
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr><td>" . $row["REQUIREMENT"] . "</td></tr>"; 
                }
                echo "</table>";
            } else if ($_POST['ck_1'] != 'ck_name' && $_POST['ck_2'] != 'ck_req' && $_POST['ck_3'] == 'ck_time') {
                //time
                $result = executePlainSQL("SELECT TimeLength FROM Job");
                echo "<br>All distinct Job information by Time Length<br>";
                echo "<table>";
                echo "<tr><th>Job Time length (months)</th></tr>";
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr><td>" . $row["TIMELENGTH"] . "</td></tr>"; 
                }
                echo "</table>";
            } else if ($_POST['ck_1'] == 'ck_name' && $_POST['ck_2'] == 'ck_req' && $_POST['ck_3'] != 'ck_time') {
                //name req
                $result = executePlainSQL("SELECT Name, Requirement FROM Job");
                echo "<br>All distinct Job information by Name, Requirement<br>";
                echo "<table>";
                echo "<tr><th>Job Name</th><th>Job Requirement</th></tr>";
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr><td>" . $row["NAME"] . "</td><td>" . $row["REQUIREMENT"] . "</td></tr>"; 
                }
                echo "</table>";
            } else if ($_POST['ck_1'] != 'ck_name' && $_POST['ck_2'] == 'ck_req' && $_POST['ck_3'] == 'ck_time') {
                //req time
                $result = executePlainSQL("SELECT Requirement, TimeLength FROM Job");
                echo "<br>All distinct Job information by Requirement, Time Length<br>";
                echo "<table>";
                echo "<tr><th>Job Requirement</th><th>Job Time length (months)</th></tr>";
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr><td>" . $row["REQUIREMENT"] . "</td><td>" . $row["TIMELENGTH"] . "</td></tr>"; 
                }
                echo "</table>";
            } else if ($_POST['ck_1'] == 'ck_name' && $_POST['ck_2'] != 'ck_req' && $_POST['ck_3'] == 'ck_time') {
                //name time
                $result = executePlainSQL("SELECT Name, TimeLength FROM Job");
                echo "<br>All distinct Job information by Name, Time Length<br>";
                echo "<table>";
                echo "<tr><th>Job Name</th><th>Job Time length (months)</th></tr>";
                while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr><td>" . $row["NAME"] . "</td><td>" . $row["TIMELENGTH"] . "</td></tr>"; 
                }
                echo "</table>";
            } else {
                //nothing
                alert("no box selected!");
            }
        }

        function alert($msg) {
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }

        // HANDLE ALL POST ROUTES
	// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
        function handlePOSTRequest() {
            if (connectToDB()) {
                if (array_key_exists('resetTablesRequest', $_POST)) {
                    handleResetRequest();
                } else if (array_key_exists('updateQueryRequest', $_POST)) {
                    handleUpdateRequest();
                } else if (array_key_exists('insertQueryRequest', $_POST)) {
                    handleInsertRequest();
                } else if (array_key_exists('deleteQueryRequest', $_POST)) {
                    handleDeleteRequest();
                } else if (array_key_exists('displayJobSubmit', $_POST)) {
                    handleJobDisplayRequest();
                } else if (array_key_exists('displayJobInfoSubmit', $_POST)) {
                    handleJobInfoDisplayRequest();
                } else if (array_key_exists('displayEmpInfoSubmit', $_POST)) {
                    handleEmpInfoDisplayRequest();
                }
                disconnectFromDB();
            }
        }

        // HANDLE ALL GET ROUTES
	// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
        function handleGETRequest() {
            if (connectToDB()) {
                if (array_key_exists('countTuples', $_GET)) {
                    handleCountRequest();
                } else if (array_key_exists('displayTuples', $_GET)) {
                    handleDisplayRequest();
                } else if (array_key_exists('displayAggGroupBySubmit', $_GET)) {
                    handleAggGroupByRequest();
                } else if (array_key_exists('displayNestAggGroupBySubmit', $_GET)) {
                    handleNestAggGroupByRequest();
                } else if (array_key_exists('displayAggHavingSubmit', $_GET)) {
                    handleAggHavingRequest();
                } else if (array_key_exists('displayDivisionSubmit', $_GET)) {
                    handleDivisionRequest();
                }
                
                disconnectFromDB();
            }
        }

		if (isset($_POST['reset']) || isset($_POST['updateSubmit']) || isset($_POST['insertSubmit']) 
        || isset($_POST['deleteSubmit']) || isset($_POST['displayJobRequest']) 
        || isset($_POST['displayJobInfoRequest']) || isset($_POST['displayEmpInfoRequest'])) {
            handlePOSTRequest();
        } else if (isset($_GET['countTupleRequest']) || isset($_GET['displayTupleRequest']) 
        || isset($_GET['displayAggGroupBy']) || isset($_GET['displayNestAggGroupBy'])
        || isset($_GET['displayAggHaving']) || isset($_GET['displayDivision'])) {
            handleGETRequest();
        }
		?>
	</body>
</html>

