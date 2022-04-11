<!DOCTYPE html>
<html>

<head>
    <!-- Compiled and minified JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <div class="container">
        <h1 style="text-align: center;">List of users</h1>

        <?php
            $filename = 'result.json';
    
            if(file_exists($filename)){
        ?>
        <table id="users">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th>Rôles</th>
                <th>Manage</th>
            </tr>
        </thead>
        </table>
        <?php
            }
        ?>

        <br />
        <a class="button" href="enregistrer.html">Create User</a>
    </div>

    <?php
        $filename = 'result.json';
        if(file_exists($filename)){
            $current_data = file_get_contents($filename);
        }
    ?>

    <script>
        const jsonData = <?php echo $current_data; ?>;
        
        var table = $('#users').DataTable({
            data: jsonData,
            columns: [
                { data: "id" },
                { data: "username" },
                { data: "email" },
                { data: "password" },
                { data: "roles"},
                {
                    data: null,
                    defaultContent: '<a id="edit" class="button-edit">Edit</a>',
                    orderable: false
                },
            ]
        });

        var index;
        $('#users').on( 'click', '#edit', function () {
            index = $(this).closest('tr').index();
            editUser();
        } );

        function editUser() {
            window.location.href = "modifier.php?id=" + jsonData[index].id;
        }
    </script>
</body>

</html>