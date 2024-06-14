<style type="text/css">
	 /*  Helper Styles */
    body {
        font-family: Varela Round;
        background: #f1f1f1;
    }

    a {
        text-decoration: none;
    }

    /* Card Styles */

    .card-sl {
        border-radius: 8px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .card-image img {
        max-height: 100%;
        max-width: 100%;
        border-radius: 8px 8px 0px 0;
    }

    .card-action {
        position: relative;
        float: right;
        margin-top: -25px;
        margin-right: 20px;
        height: 70px;
    	width: 70px;
        z-index: 2;
        color: #E26D5C;
        background: #fff;
        border-radius: 100%;
        padding: 15px;
        font-size: 15px;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);
    }

    .card-action:hover {
        color: #fff;
        background: #E26D5C;
        -webkit-animation: pulse 1.5s infinite;
    }

    .card-heading {
        font-size: 18px;
        font-weight: bold;
        background: #fff;
        padding: 10px 15px;
    }

    .card-text {
        padding: 10px 15px;
        background: #fff;
        font-size: 14px;
        color: #636262;
    }

    .card-button {
        display: flex;
        justify-content: center;
        padding: 10px 0;
        width: 100%;
        background-color: #1F487E;
        color: #fff;
        border-radius: 0 0 8px 8px;
    }

    .card-button:hover {
        text-decoration: none;
        background-color: #1D3461;
        color: #fff;

    }


    @-webkit-keyframes pulse {
        0% {
            -moz-transform: scale(0.9);
            -ms-transform: scale(0.9);
            -webkit-transform: scale(0.9);
            transform: scale(0.9);
        }

        70% {
            -moz-transform: scale(1);
            -ms-transform: scale(1);
            -webkit-transform: scale(1);
            transform: scale(1);
            box-shadow: 0 0 0 50px rgba(90, 153, 212, 0);
        }

        100% {
            -moz-transform: scale(0.9);
            -ms-transform: scale(0.9);
            -webkit-transform: scale(0.9);
            transform: scale(0.9);
            box-shadow: 0 0 0 0 rgba(90, 153, 212, 0);
        }
    }
    .txt4{
        font-size:20px;
        position: relative;
        /*top: 33px;*/
    }
    .txt2{
    	font-size:25px;
        position: relative;
        color: red;
    }
    .cr_img{
    	    
		    position: relative;
		    width: 96%;
		    height: 375px;
		    

    	}
</style>

<?php
	/*print_r($criminal_info);
	echo "\n\n";
	print_r($matchInfo);*/

	/************** OUTPUT *******************/
	/*Array ( [0] => stdClass Object ( [name] => aa [criminal_id] => 12 [crime] => kk [police_station] => ii [image_path] => C:/xampp/htdocs/FaceRecognition/uploads/a1.jpeg ) ) Found*/
	
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!--Container Main start-->
<div class="height-100 bg-light main-content">
        <!-- <h4>Main Components</h4> -->
		<div class="container" style="margin-top:50px;">
        <div class="row">
            <div class="col-md-5 offset-md-3 ">
            	<?php 
            		if($matchInfo=="Found"){
            			$image_path = explode('/',trim($criminal_info[0]->image_path));
						$img_path = $image_path[4]."/".$image_path[5];
            	?>
                <div class="card-sl">
                    <div class="card-image">
                        <!-- <img
                            src="https://images.pexels.com/photos/1149831/pexels-photo-1149831.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" /> -->

                         <center><img class="cr_img" src="<?php echo base_url().$img_path;?>" /></center>
                    </div>

                    <a class="card-action" href="#"><center><i class="fa-solid fa-bell fa-xl"></i></center></a>
                    <!-- <div class="card-heading">
                        Audi Q8
                    </div> -->
                    <div class="card-text txt4">
                       <b> Name : </b> <?php echo $criminal_info[0]->name;?>
                    </div>
                    <div class="card-text txt4">
                    	<b> Criminal ID : </b> <?php echo $criminal_info[0]->criminal_id;?>        
                    </div>
                    <div class="card-text txt4">
                        <b> Crime : </b> <?php echo $criminal_info[0]->crime;?>
                    </div>
                    <div class="card-text txt4">
                        <b> Police Station : </b> <?php echo $criminal_info[0]->police_station;?>
                    </div>
                    <!-- <a href="#" class="card-button"> Purchase</a> -->
                </div>
            <?php } 
            	else{
            ?>
            	<div class="card-sl">
                    <div class="card-image">                        

                         <center><img class="cr_img" src="<?php echo base_url();?>assets/img/user.jpg" /></center>
                    </div>

                    <div class="card-text txt2">
                       <center><b> No Match Found !!! </b> </center>
                    </div>
                    
                    <!-- <a href="#" class="card-button"> Purchase</a> -->
                </div>
            <?php
            }
            ?>

            </div>
        </div>  
</div>

