<?php
require_once('rentbuy.php');
$mango = new RentBuy($_POST);
$handle = fopen("counter.txt", "r");
//Visitor Increase
if ($handle) {
    $counter = (int)fread($handle, 20);
    fclose($handle);
    $counter++;
    $handle = fopen("counter.txt", "w");
    fwrite($handle, $counter);
    fclose($handle);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="google-site-verification" content="1SHln42f8-F_zgj9KWrC44ypUizOqj1bFxrcpNzz9UE" />
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Rent vs buy | Should I rent or should I buy?</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>


    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="container">
    <!-- Static navbar -->
    <div class="navbar" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><img src="/home-logo.png"/></a>
            </div>
            <div class="navbar-collapse collapse">

                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="/">Buy?</a></li>
                    <li><a href="#">Terms</a></li>
                    <li><a href="#">About</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
        <!--/.container-fluid -->
    </div>

    <!-- Main component for a primary marketing message or call to action -->
    <?php if (!$_POST['value']) { ?>
        <div class="jumbotron" style="background:white;border:#ccc 1px solid;overflow:hidden;">
            <div class="col-md-8">
                <h1>Should I buy?</h1>

                <p>Should I buy or should I rent? This is one of the most important questions every renter faces. Don't
                    follow the herd. Sometimes buying
                    is not the best option. We offer here a free, quick and easy way to validate if buying is best for
                    you or if you
                    should stick to rental. Our service has proudly answered this question <span
                        class="badge"><?php echo $counter;?></span> times already.
                </p>
            </div>
            <?php include_once('bigrectangle.php');?>
        </div>

    <?php } else { ?>
        <h1>Results</h1>

        <div style="margin-bottom:20px;">
            <span style="font-size:14px;" class="label label-default">Value: $<?php echo $mango->getValue();?></span>
            <span style="font-size:14px;"
                  class="label label-default">Downpayment: $<?php echo $mango->getDown();?></span>
            <span style="font-size:14px;"
                  class="label label-default">Interest Rate: <?php echo $mango->getInterestRate();?>%</span>
            <span style="font-size:14px;" class="label label-default">Term: <?php echo $mango->getTerm();?> years</span>
            <span style="font-size:14px;" class="label label-default">Exit: <?php echo $mango->getExit();?> years</span>
        </div>
        <div class="col-md-8">
            <?php echo ($mango->getDiffBuyRent() > 0) ? '<h2 class="text-center"><span class="label label-success">Buy, don\'t rent!</span></h2>' : '<h2 class="text-center"><span class="label label-danger">Rent, don\'t buy!</span></h2>';?>
            <table class="table" style="margin-top:40px;">
                <tr>
                    <td><strong>Expenses</strong></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Total Interest</td>
                    <td>$<?php echo round($mango->getTotalInterest(), 2);?></td>
                </tr>
                <tr>
                    <td>Municipal tax</td>
                    <td>$<?php echo round($mango->getTotalMunicipal(), 2);?></td>
                </tr>
                <tr>
                    <td>School tax</td>
                    <td>$<?php echo round($mango->getTotalSchool(), 2);?></td>
                </tr>
                <tr>
                    <td>Mortgage Insurance</td>
                    <td>$<?php echo round($mango->getTotalInsurance(), 2);?></td>
                </tr>
                <tr>
                    <td>Renovations</td>
                    <td>$<?php echo round($mango->getTotalRenovatons(), 2);?></td>
                </tr>
                <tr>
                    <td>Condo/HOA Fees</td>
                    <td>$<?php echo round($mango->getTotalCondo(), 2);?></td>
                </tr>
                <tr>
                    <td>Snow Removal/Lawn Mowing</td>
                    <td>$<?php echo round($mango->getTotalSnow(), 2);?></td>
                </tr>
                <tr>
                    <td>Welcome tax</td>
                    <td>$<?php echo round($mango->getTotalWelcome(), 2);?></td>
                </tr>
                <tr>
                    <td>Notary Fees</td>
                    <td>$<?php echo round($mango->getTotalNotary(), 2);?></td>
                </tr>
                <tr>
                    <td>Mortgage Breaking Penalty</td>
                    <td>$<?php echo round($mango->getTotalPenalty(), 2);?></td>
                </tr>
                <tr style="border-top:2px solid #ccc">
                    <td><strong>Total Expenses Lost</strong></td>
                    <td><strong>$<?php echo round($mango->getTotalLoss(), 2);?></strong></td>
                </tr>
                <tr>
                    <td>Total Principal Paid</td>
                    <td>$<?php echo round($mango->getTotalPrincipal(), 2);?></td>
                </tr>
                <tr style="border-top:2px solid #ccc">
                    <td><strong>Total Cash Invested</strong></td>
                    <td><strong>$<?php echo round($mango->getTotalCashOut(), 2);?></strong></td>
                </tr>
                <tr>
                    <td>Proceeds from Sale of the Appreciated Home</td>
                    <td>$<?php echo round($mango->getTotalAppreciatedCapital(), 2);?></td>
                </tr>
                <tr style="border-top:2px solid #ccc">
                    <td><strong>Profit or Loss from Home Purchase</strong></td>
                    <td><strong>$<?php echo round($mango->getProfitFromBuying(), 2);?></strong></td>
                </tr>
                <tr>
                    <td>Total Cost of Rent</td>
                    <td>$<?php echo round($mango->getTotalRent(), 2);?></td>
                </tr>
                <tr class="text-<?php echo ($mango->getDiffBuyRent() > 0) ? "success" : "danger" ?>"
                    style="border-top:2px solid #ccc">
                    <td><strong>Difference between Buying and Renting</strong></td>
                    <td><strong>$<?php echo round($mango->getDiffBuyRent(), 2);?></strong></td>
                </tr>
            </table>
            <?php include_once('banner.php');?>
            <h3>Monthly Payments Overview</h3>

            <table class="table">
                <tr>
                    <td>Mortage will be paid completely in</td>
                    <td><?php echo round($mango->getLastPayment()/12, 2);?> years</td>
                </tr>
                <tr>
                    <td>Recurrent Biweekly Mortgage Payment</td>
                    <td>$<?php echo round($mango->getPmt(), 2);?></td>
                </tr>
                <tr>
                    <td>Recurrent Non-Mortgage Expenses per Month</td>
                    <td>$<?php echo round($mango->getRecurrentNonMortgage(), 2);?></td>
                </tr>
                <tr>
                    <td>Non-Recurrent Expenses at Beginning</td>
                    <td>$<?php echo round($mango->getTotalWelcome() + $mango->getTotalNotary(), 2);?></td>
                </tr>
                <tr>
                    <td>Non-Recurrent Expenses at End</td>
                    <td>$<?php echo round($mango->getTotalPenalty(), 2);?></td>
                </tr>
                <tr>
                    <td>Average Monthly Payment</td>
                    <td>
                        $<?php echo round(($mango->getTotalCashOut() - $mango->getDown()) / (12 * $mango->getExit()), 2);?></td>
                </tr>
            </table>
        </div>
        <?php include_once('wideskyscraper.php');
        include_once('rectangle.php');
    }
    ?>
    <div style="clear:both;display:block">
        <hr>
        <h2>Your data</h2>
        <?php include_once('form.php');?>
    </div>
    <?php include_once("disqus.php"); ?>
    <?php include_once("facebook.php"); ?>
</div>
<!-- Bootstrap core JavaScript
================================================== -->

<!-- Placed at the end of the document so the pages load faster -->
<footer role="contentinfo" xmlns="http://www.w3.org/1999/html">
    <div class="container text-center">
        <div class="col-md-12">
            <h2 class="lead">Like our service? please share!</h2>

            <div class="fb-like text-center" data-href="https://www.facebook.com/pages/Rent-vs-Buy/474304256048676"
                 data-width="300" data-layout="button_count" data-action="like" data-show-faces="true"
                 data-share="true"></div>
            <p style="margin-top:50px;"> © 2013 Rent vs Buy.</p>
        </div>
    </div>
</footer>
<?php include_once("analytics.php"); ?>

</body>
</html>
