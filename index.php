<?php
/**
 * Created by PhpStorm.
 * User: s.mines
 * Date: 23/01/2018
 * Time: 15:51
 */

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Welcome!</title>
    <link rel="icon" type="image/png" href="favicon.png" />
    <link rel="stylesheet" href="js/bootstrap.js">
    <link rel="stylesheet" href="css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/neon-core.css">
    <link rel="stylesheet" href="css/neon-theme.css">
    <link rel="stylesheet" href="css/neon-forms.css">
    <link rel="stylesheet" href="css/skins/blue.css">
    <link rel="stylesheet" href="css/custom.css">
</head>
<style>
    body { background: #F5F5F5; font: 18px/1.5 sans-serif; }
    h1, h2 { line-height: 1.2; margin: 0 0 .5em; }
    h1 { font-size: 36px; }
    h2 { font-size: 21px; margin-bottom: 1em; }
    p { margin: 0 0 1em 0; }
    a { color: #0000F0; }
    a:hover { text-decoration: none; }
    code { background: #F5F5F5; max-width: 100px; padding: 2px 6px; word-wrap: break-word; }
    #wrapper { background: #FFF; margin: 1em auto; max-width: 1200px; width: 95%; }
    #container { padding: 2em; }
    #welcome, #status { margin-bottom: 2em; }
    #welcome h1 span { display: block; font-size: 75%; }
    #icon-status, #icon-book { float: left; height: 64px; margin-right: 1em; margin-top: -4px; width: 64px; }
    #icon-book { display: none; }
</style>
<?php
    $pathSource = "/home/admin/";
    $fileSource = "import_traces.log";
    $table = array();
    try{
        if(!file_exists($pathSource.$fileSource)){
            throw new Exception('File "'.$fileSource.'" not found.');
        }
        $handle = fopen($pathSource.$fileSource, "r");
        if($handle){
            while (($line = fgets($handle)) !== false) {
                $expression = explode("|",$line);
                $expression[3] = substr($expression[3], 0, 2);
                array_push($table, $expression);
            }
            fclose($handle);
        }
    }
    catch (Exception $e){
        echo "<div id='wrapper'><h3>".$e->getMessage()."</h3></div>";
    }

?>
<body>
    <div id="wrapper">
        <div id="container">
            <table class="table table-bordered table-striped dataTable" style="font-size: 20px;">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Date début</th>
                        <th>Date de fin</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($table as $tab){
                            if($tab[3] == "OK"){
                                echo "<tr style='background-color: rgba(0,255,0,0.3);'>";
                                    echo "<td>".$tab[0]."</td>";
                                    echo "<td>".$tab[1]."</td>";
                                    echo "<td>".$tab[2]."</td>";
                                    echo "<td>".$tab[3]."</td>";
                                echo "</tr>";
                            }
                            else{
                                echo "<tr style='background-color: rgba(255,0,0,0.2);'>";
                                    echo "<td>".$tab[0]."</td>";
                                    echo "<td>".$tab[1]."</td>";
                                    echo "<td>".$tab[2]."</td>";
                                    echo "<td>".$tab[3]."</td>";
                                echo "</tr>";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
