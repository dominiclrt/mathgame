<?php 
    session_start();
    
    $ans = null;
    if (!isset($_SESSION["authenticated"])) {
        header("Location: login.php");
    }
    include("include/header.php"); 
    if (!isset($total)) {
        $total = 0;
    }
    if (!isset($score)) {
        $score = 0;
    }
    extract($_POST);
    if ( isset($first_number) 
        && isset($operation) 
        && isset($second_number) 
        && isset($answer) 
    ) {
        $ans = "";
        if ( !is_numeric($answer) ) {
            $ans = "<span style='color: red; font-weight: bold;'>You must enter a number for your answer.</span>";
        } else 
        switch ($operation) {
            case "+":
                $result = $first_number + $second_number;
                if ($result == $answer) {
                    $ans = "<span style='color: green; font-weight: bold;'>Correct</span>";
                    $score++;
                } else {
                    $ans = "<span style='color: red; font-weight: bold;'>INCORRECT, $first_number + $second_number is $result.</span>";
                }
                $total++;
                break;
            case "-":
                $result = $first_number - $second_number;
                if ($result == $answer) {
                    $ans = "<span style='color: green; font-weight: bold;'>Correct</span>";
                    $score++;                    
                } else {
                    $ans = "<span style='color: red; font-weight: bold;'>INCORRECT, $first_number - $second_number is $result.</span>";
                }
                $total++;
                break;
        }
    }
    $num1 = rand(0,20);
    $num2 = rand(0,20);
    $operand_determiner = rand(1,2);
    $operand = "";
    
    switch ($operand_determiner) {
        case 1:
            $operand = "+";
            break;
        case 2:
            $operand = "-";
            break;
    }
  
?>
<body>
    <div class="container">
        <form action="index.php" method="post" role="form" class="form-horizontal">
            <div class="row">
                <div class="col-md-4 col-sm-offset-4"><h1>A Game of Maths</h1></div>
                <div class="col-md-4"><a href="logout.php" class="btn btn-default btn-sm">Logout</a></div>
            </div>
            <div class="row">
                <label class="col-md-2 col-sm-offset-3"><?php echo $num1; ?></label>
                <label class="col-md-2"><?php echo $operand; ?></label>
                <label class="col-md-2"><?php echo $num2; ?></label>
                <div class="col-md-3"></div>
            </div>

            <input type="hidden" name="first_number" value="<?php echo $num1; ?>" />
            <input type="hidden" name="operation" value="<?php echo $operand; ?>" />
            <input type="hidden" name="second_number" value="<?php echo $num2; ?>" />
            <input type="hidden" name="total" value="<?php echo $total; ?>" />
            <input type="hidden" name="score" value="<?php echo $score; ?>" />

            <div class="form-group">
                <div class="col-md-3 col-md-offset-4">
                    <input type="text" class="form-control" id="answer" name="answer" placeholder="Enter answer" size="6">
                </div>
                <div class="col-md-5"></div>
            </div>
            <div class="row">
                <div class="col-md-3 col-md-offset-4">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" class="btn btn-primary btn-sm">
                    Submit</button>
                </div>
                <div class="col-md-3"></div>
            </div>
        </form>
        <hr />
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <?php echo $ans; ?>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">Score: <?php echo "$score / $total" ?></div>
            <div class="col-md-4"></div>
        </div>
        
<?php include("include/footer.php"); ?>