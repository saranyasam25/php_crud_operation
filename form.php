        <!-- form modal -->
        <div class="modal fade" id="usermodal" role="dialog" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adding or Updating Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!--  -->
                    <form action="" id="addform"name="addform" method="post" enctype="multipart/form-data">
                        
                        <div class="modal-body">
                            <!-- username -->
                            <div class="form-group my-2">
                                <label for="">Name:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text pt-2 user-icon">
                                        <i class="fa-solid fa-user text-light py-1 "></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Enter Your UserName." autocomplete=off required="required" id="username" name=username>
                                    <span></span>
                                </div>
                            </div>
                            <!-- email -->
                            <div class="form-group  my-2">
                                <label for="">Email:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text pt-2 user-icon">
                                     
                                        <i class="fa-solid fa-envelope text-light py-1"></i>
                                        </span>
                                    </div>
                                    <input type="email" class="form-control" placeholder="Enter Your email." autocomplete=off required="required" id="email" name="email" >
                                </div>
                            </div>
                            <!-- mobile -->
                            <div class="form-group  my-2">
                                <label for="">Mobile:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text pt-2 user-icon">
                                        <i class="fa-solid fa-phone text-light py-1 "></i>
                                       
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Enter Your mobile." autocomplete=off required="required" id="mobile" name="mobile" maxLength="10" minLength="10" >
                                </div>
                            </div>
                            <!-- photo -->
                            <div class="form-group  my-2">
                                <label for="">Photo:</label>
                                <div class="input-group">
                                   <label for="userphoto" class="custom-file-label">Choose File</label>
                                    <input type="file" class="custom-file-input" scr="./uploads/" name="photo" id="userphoto" >
                                </div>
                                <div id="image-preview" src="" alt="Preview"></div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-dark">Submit</button>
                            <button type="button" class="btn btn-danger close-btn" data-bs-dismiss="modal">Close</button>


                            <!-- 2 input fields first for adding and next updating,deleting,viewing profile -->
                            <input type="hidden" name="action" value="adduser">
                            <input type="hidden" name="userId" id="userId" value="">
                            
                        </div>

                    </form>
                </div>
            </div>
        </div>