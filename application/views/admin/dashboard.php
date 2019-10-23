<br>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-horizontal">
                    <div class="row">
                        <div class="col-4 vcenter">
                            <div class="img-square-wrapper">
                                <img class="" src="<?php echo $data['product_image'] ?>" alt="Product image" style="height: 200px;width: 200px;">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $data['name'] ?></h4>
                                <div class="row">
                                    <div class="col-md-5">
                                        <label><?php echo $data['weight'] . ' ' . $data['unit'] ?></label>
                                    </div>
                                    <div class="col-md-5">
                                        <h5 style="color:#11e12d;"><i class="fa fa-gift"></i> <?php echo $data['location'] ?></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <label style="color:blue;color:black;">Rs.<?php echo $data['price'] ?></label>
                                    </div>
                                    <div class="col-md-5">
                                    </div>
                                </div>

                                <label>Details</label><br>
                                <p><?php echo $data['description'] ?></p>
                                <h6>Subscribe</h6>
                                <div class="row">
                                    <div class="col-md-3 col-sm-4 tab">
                                        <button onclick="everyday()" id="everyday" class="btn button">
                                            <i class="fa fa-calendar" id="icon1" style="color:black;"></i> Everyday</button>
                                    </div>
                                    <div class="col-md-3 col-sm-4 tab">
                                        <button onclick="onetime()" id="onetime" class="btn button">
                                            <i class="fa fa-calendar" id="icon2" style="color:black;"></i> One Time order</button>
                                    </div>
                                    <div class="col-md-3 col-sm-4 tab">
                                        <button onclick="customize()" id="customize" class="btn button">
                                            <i class="fa fa-calendar" id="icon3" style="color:black;"></i> Customize</button>
                                    </div>
                                    <div class="col-md-3 col-sm-4 tab">
                                        <button onclick="interval()" id="interval" class="btn button">
                                            <i class="fa fa-calendar" id="icon4" style="color:black;"></i> On Interval</button>
                                    </div>
                                </div> <br>
                                <div class="row" id="customize_box" style="display:none;">
                                    <div class="box grey">
                                        <?php
                                        $current_index = 7;
                                        foreach ($weeks as $key => $week_row) {
                                            $limited_word = substr($week_row, 0, 1);
                                            if ($week_row == date('l') || $key >= $current_index) {
                                                ?>
                                                <div class="flex-container">
                                                    <div class="box1"><?php echo $limited_word; ?></div>
                                                    <div class="box2">0</div>
                                                </div>
                                                <?php
                                                $current_index = $key;
                                            } else {
                                                ?>
                                                <div class="flex-container">
                                                    <div class="box3"><?php echo $limited_word; ?></div>
                                                    <div class="box2">0</div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>

                                    </div>
                                </div>
                                <div class="row" id="interval_box" style="display:none;">
                                    <div class="box grey">
                                        <div class="flex-container">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-6" style="padding: 0px 10px;"><button id="onetime" class="btn day_button" style="background-color: black;color:white;border-color: black;">On 2nd Day</button></div>
                                            <div class="col-md-6" style="padding: 0px 10px;"><button id="onetime" class="btn day_button">On 3nd Day</button></div>
                                            <div class="col-md-6" style="padding: 0px 10px;"><button id="onetime" class="btn day_button">On 4nd Day</button></div>
                                            <div class="col-md-2"></div>
                                        </div>
                                    </div>
                                </div>
                                <br><br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h6>Quantity</h6>
                                        <span class="minus">-</span>
                                        <input class="input_count" type="text" value="1" />
                                        <span class="plus">+</span>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="group">
                                            <input class="input_material datetimepicker" type="text" value="<?php echo date("d M Y", strtotime($data['start_date'])); ?>" required>
                                            <label style="position: absolute;">Starts On</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>
                                    <div class="col-md-2">
                                        <div class="group">
                                            <div class="input-icons"> 
                                                <input class="input_material datetimepicker" value="<?php echo date("d M Y", strtotime($data['end_date'])); ?>" type="text" required>
                                                <label style="position: absolute;">Ends On</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br><br>
                                <div class="row">
                                    <div class="col-md-12 col-sm-4">
                                        <button id="everyday" class="btn button_subscribe">Subscribe</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
            </div>
        </div>

    </div>
</div>

<script>
    var x = document.getElementById("customize_box");
    var y = document.getElementById("interval_box");
    var icon1 = document.getElementById("icon1");
    var icon2 = document.getElementById("icon2");
    var icon3 = document.getElementById("icon3");
    var icon4 = document.getElementById("icon4");

    function everyday() {
        x.style.display = "none";
        y.style.display = "none";
        icon1.style.color = "white";
        icon2.style.color = "black";
        icon3.style.color = "black";
        icon4.style.color = "black";
    }

    function onetime() {
        x.style.display = "none";
        y.style.display = "none";
        icon1.style.color = "black";
        icon2.style.color = "white";
        icon3.style.color = "black";
        icon4.style.color = "black";
    }

    function customize() {
        x.style.display = "block";
        y.style.display = "none";
        icon1.style.color = "black";
        icon2.style.color = "black";
        icon3.style.color = "white";
        icon4.style.color = "black";
    }

    function interval() {
        x.style.display = "none";
        y.style.display = "block";
        icon1.style.color = "black";
        icon2.style.color = "black";
        icon3.style.color = "black";
        icon4.style.color = "white";
    }
</script>