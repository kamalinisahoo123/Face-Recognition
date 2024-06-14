<!--Container Main start-->
    <div class="height-100 bg-light main-content">
        <!-- <h4>Main Components</h4> -->


   <div class="col-md-6 offset-md-3 mt-5">
       
        <center> <h1>FILL CRIMINAL INFORMATION</h1></center>
        <form accept-charset="UTF-8" action="<?php echo base_url();?>FormUpload/saveInfo" enctype="multipart/form-data" method="POST">

            <?php if ($this->session->flashdata('media_filed')) { ?>
                  <div class="alert alert-warning">
                      <?php echo $this->session->flashdata('media_filed'); ?> 
                  </div>   
                 <?php } 
                 if ($this->session->flashdata('media_success')) {
                 ?> 
                  <div class="alert alert-success">
                         <?php echo $this->session->flashdata('media_success'); ?> 
                     </div>   
           <?php }
           ?>


          <div class="form-group" style="padding: 18px;">
            <label for="exampleInputName">Full Name</label>
            <input type="text" name="name" id="name" class="form-control" id="exampleInputName" placeholder="Enter name and surname" required="required">
          </div>
          <div class="form-group" style="padding: 18px;">
            <label for="exampleInputEmail1" required="required">Criminal Id</label>
            <input type="text" name="criminal_id" id="criminal_id" class="form-control" id="exampleInputEmail1" onchange="checkid()" aria-describedby="emailHelp" placeholder="Enter Criminal Id">
          </div>

          <div class="form-group" style="padding: 18px;">
            <label for="exampleInputEmail1" required="required">Crime</label>
            <input type="text" name="crime" id="crime" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Crime">
          </div>

          <div class="form-group" style="padding: 18px;">
            <label for="exampleInputEmail1" required="required">Police Station</label>
            <input type="text" name="police_station" id="police_station" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Police Station">
          </div>

          <!-- <div class="form-group" style="padding: 18px;">
            <label for="exampleFormControlSelect1">Favourite Platform</label>
            <select class="form-control" id="exampleFormControlSelect1" name="platform" required="required">
              <option>Github</option>
              <option>Gitlab</option>
              <option>Bitbucket</option>
            </select>
          </div> -->
          
          <div class="form-group mt-3" style="padding: 18px;">
            <label class="mr-2">Upload Image:</label>
            <input type="file" id="profile_image" name="profile_image">
          </div>
          <hr>
          <center>
          <button type="submit" class="btn btn-primary">Submit</button>
          </center>
        </form>
    </div> 
    

    </div>
    <!--Container Main end-->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript">
    function checkid()
    {
        var criminal_id = document.getElementById('criminal_id').value;
        //alert(criminal_id);

        var controller = 'FormUpload';
        var base_url = '<?php echo site_url(); ?>';
        action = base_url + controller + '/check_criminal_id';       
        
          $.ajax({
              url: action,
              type: 'POST',
              data:{criminal_id:criminal_id},
              cache: false,
              success: function (response) {   
              //console.log(response);      
              if(response=='1')
              {
                  Swal.fire({
                    icon: 'error',
                    title: 'Invalid Criminal ID',
                    text: 'Criminal ID already exist!',
                    
                  })
              }

            }
          });
    }
  </script>