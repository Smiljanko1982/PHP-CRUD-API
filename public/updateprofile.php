<?php include ('includes/header.php'); ?>


 

  
<?php include("includes/functions.php") ?>
   

<div class="container">
 
        <div>
            <header class="section_header">
                <h4>Updating Your Profile</h4><hr>
            </header>
        <div class="col-md-6 col-md-offset-3">
                <form action="<?php $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
               
                    <div class="form-group">
                        <label class="" for="reason">Select Reason for Membership:</label>
                         <div class="">
                             <select class="form-control" id="" name="reason" required>
                                <option value="Not Defined">Select Reason</option>
                                <option value="Personal">Personal</option>
                                <option value="Family">Family</option>
                                <option value="Friend">Friend</option>
                                <option value="Contract">Contract</option>
                             </select>
                          </div>
                    </div>

                     <div class="form-group">
                      <label class="" for="name">Full Name</label>
                      <div class="">
                        <input type="name" class="form-control" name="fullname" placeholder="Enter Full Name" value="">
                      </div>
                    </div>
                     <div class="form-group">
                      <label class="" for="prof">Profession</label>
                      <div class="">
                        <input type="text" class="form-control" name="profession" placeholder="Enter Profession" value="">
                      </div>
                    </div>
                     <div class="form-group">
                      <label class="" for="facebook">Facebook</label>
                      <div class="">
                        <input type="url" class="form-control" name="facebook" placeholder="Enter facebook url" value="">
                      </div>
                    </div>
                     <div class="form-group">
                      <label class="" for="country">Country</label>
                      <div class="">
                        <input type="text" class="form-control" name="country" placeholder="Enter Country" value="">
                      </div>
                    </div>
                     <div class="form-group">
                      <label class="" for="text">Summary</label>
                      <div class="">
                          <textarea type="text" class="form-control" name="summary" value="" placeholder="In brief, about yourself" required></textarea>
                      </div>
                    </div>
                    <div class="form-group">

                      <label class="" for="file">Upload Medical Certification:</label>
                      <div class="">
                  
                        <input type="file" name="image" placeholder="Upload Profile Image" required />
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="">
                        <button type="submit" class="btn btn-primary" name="update_profile">Update Profile</button><a href="user-account.php" class="btn btn-danger pull-right" style="color: #fff;">Cancel</a><hr>
                      </div>
                    </div>

                   
            </form>

                    <br />

                                
            </div>
                                    
       </div>

  
</div><!--page content-->

<?php include ('includes/footer.php'); ?>