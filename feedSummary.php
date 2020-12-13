<?php
    session_start();
    include 'includes/database.php';
    include 'includes/action.php';
?>
<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php include "{$_SERVER['DOCUMENT_ROOT']}/epms/partials/_head.php";?>
<body id="body">
    <div class="container">
        <!-- top navbar -->
        <?php include "{$_SERVER['DOCUMENT_ROOT']}/epms/partials/_top_navbar.php";?>
        <main>
            <div class="main__container">
                <!-- dashboard title and greetings -->
                <div class="main__title">
                    <!-- <img src="images/hello.svg" alt=""> -->
                    <div class="main__greeting">
                        <h1>Feed Stock Summary</h1>
                    </div>
                </div>
                <!-- dashboard title ends here -->

                <!-- Cards for displaying CRUD insights -->
                <div class="main__cards">
                    <div class="card">
                        <div class="card_inner">
                            <p class="text-primary-p">No. of Birds</p>
                            <!-- <span class="font-bold text-title">578</span> -->
                            <span class="font-bold text-title">
                                <?php
                                    echo $totalNumberOfBirds;
                                ?>
                            </span>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card_inner">
                            <p class="text-primary-p">Mortality Rate</p>
                            <!-- <span class="font-bold text-title">578</span> -->
                            <span class="font-bold text-title">
                                <?php
                                    echo $mortalityRate . '%';
                                ?>
                            </span>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card_inner">
                            <p class="text-primary-p">No. of Eggs</p>
                            <!-- <span class="font-bold text-title">578</span> -->
                            <span class="font-bold text-title">
                                <?php
                                    echo $totalNumberOfEggs;
                                ?>
                            </span>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card_inner">
                            <p class="text-primary-p">No. of Employees</p>
                            <!-- <span class="font-bold text-title">578</span> -->
                            <span class="font-bold text-title">
                                <?php
                                    echo $totalNumberOfEmployees;
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- End of cards for displaying CRUD insights -->
                <!-- Start of charts for displaying CRUD insights -->
                <div class="charts">
                    <div class="charts__left">
                        <div class="charts__left__title">
                            <div>
                                <h1>Payroll Visualtion</h1>
                                <p>Eggcellent Palace, Accra, GH</p>
                            </div>
                            <i class="fa fa-money" aria-hidden="true"></i>
                        </div>
                        <div id="apex1"></div>
                    </div>

                    <div class="charts__right">
                        <div class="charts__right__title">
                            <div>
                                <h1>Stats</h1>
                                <p>Eggcellent Palace, Accra, GH</p>
                            </div>
                            <i class="fa fa-money" aria-hidden="true"></i>
                        </div>

                        <div class="charts__right__cards">
                            <div class="card1">
                            <h1>Total Wages</h1>
                            <p><?php echo 'GHC '. $totalWages; ?></p>
                        </div>

                        <div class="card2">
                            <h1>Sales</h1>
                            <p><?php echo 'GHC '. $sales; ?></p>
                        </div>

                        <div class="card3">
                            <h1>Remaining Feed</h1>
                            <?php
                                if($remainingFeed > 0){ ?>
                                    <p><?php echo $remainingFeed . ' Kg'; ?></p>
                                <?php
                                }else{?>
                                    <p style="color: red;"><?php echo 'Please refill the feed stock!'; ?></p>
                                <?php
                                }
                                ?>
                        </div>

                        <div class="card4">
                            <h1>Eggs Left</h1>
                            <?php
                                if($remainingEggs > 0){ ?>
                                    <p><?php echo $remainingEggs; ?></p>
                                <?php
                                }else{?>
                                    <p style="color: red;"><?php echo 'Nothing to sell!'; ?></p>
                                <?php
                                }
                                ?>
                        </div>
                    </div>
                </div>
                <!-- End of charts for displaying CRUD insights -->
            </div>
        </main>
        <!-- sidebar nav -->
        <?php include "{$_SERVER['DOCUMENT_ROOT']}/epms/partials/_side_bar.php";?>
    </div>
    <script src="script.js"></script>
</body>
</html>