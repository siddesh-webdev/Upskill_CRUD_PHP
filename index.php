<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://ajax.cdnjs.com/ajax/libs/json2/20110223/json2.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/common.css">
    <style>
        .custom-alert {
            position: fixed;
            top: 25px;
            right:25px;
        }

    </style>
</head>
<body class='bg-light'>


<div class="container" id="main-content">
    <div class="row">
      <div class="col ms-auto p-4 overflow-hidden">
        <h3 class="mb-4">Employee Records</h3>
       
          <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal" data-bs-target="#AddModel">
                  ADD Employee
              </button>

            <div class="card border-0 shadow mb-4" >
              <div class="card-body">

                 <div class="text-end mb-4">
                  
                  <input type="text" id="search_input" oninput="get_users(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type to search..">
                
                  </div>
               
                <div class="table-responsive">
                <table class="table table-hover border" style="min-width: 1200px;">
                    <thead>
                      <tr class="bg-dark text-light">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Gender & Email</th>
                        <th scope="col">DOB & Contact</th>
                        <th scope="col">Address </th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody id="table-data">
                      
                    </tbody>
                  </table> 
                </div>

                <nav>
                  <ul class="pagination mt-3" id="table-pagination">
                    
                  </ul>
                </nav>

              </div>
            </div>

      </div>
    </div>
</div>

 <!-- Addmodel -->

 <div class="modal fade" id="AddModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="add-form">
        <div class="modal-header">
            <h5 class="modal-title d-flex align-items-center" ><i class="bi bi-person-lines-fill fs-3 me-2"></i> Employee Details</h5>
            <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="image-alert"></div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Name</label>
                        <input name="name" type="text" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Middle</label>
                        <input name="mname" type="text" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Sirname</label>
                        <input name="lname" type="text" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Email</label>
                        <input name="email" type="email" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-4  mb-3">
                        <label class="form-label">Phone Number</label>
                        <input name="phonenum" type="number" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Picture</label>
                        <input name="profile" type="file" accept=".jpg, .jpeg, .png, .webp" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Pin Code</label>
                        <input name="pincode" type="number" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Date of Birth</label>
                        <input name="dob" type="date" class="form-control shadow-none" required>
                    </div>

                    <div class="col-md-4 mb-3">
                     <label class="form-label">Gender</label>
                      <select name="gender" class="form-select" aria-label="Default select example">
                        <option selected>Select Gender </option>
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                        <option value="3">Others</option>
                      </select>
                    </div>

                    <h5 class="modal-title d-flex mb-3" ><i class="bi bi-geo-alt-fill me-2 "></i>  Address Details</h5>
                   
                    <div class="col-md-6 mb-3">
                        <label class="form-label">State</label>
                        <input name="state" type="text" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Country</label>
                        <input name="country" type="text" class="form-control shadow-none" required>
                    </div>
                    <!-- Address details -->
                        
                    <div id="addressFields">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Address line</label>
                                <textarea name="address" class="form-control shadow-none" rows="1" required></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Button to add more address fields -->
                    <div class="col-md-6 mb-3">
                        <button type="button" onclick="addAddressLine()" class="btn btn-outline-dark shadow-none">Add more</button>
                        <button type="button" onclick="removeAddressLine()" class="btn btn-outline-dark shadow-none">Remove</button>
                    </div>
                   
                
                </div>
            </div>
            <div class="text-center my-1">
            <button type="submit" class="btn btn-dark shodow-none">Submit </button> 
            </div>
            
        </div>
        </form>
        </div>
        </div>
</div>
    
<!--editmodel-->

<div class="modal fade" id="editModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="edit-form">
        <div class="modal-header">
            <h5 class="modal-title d-flex align-items-center" ><i class="bi bi-person-lines-fill fs-3 me-2"></i> Update Details</h5>
            <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="image-alert"></div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Name</label>
                        <input name="name" type="text" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Middle</label>
                        <input name="mname" type="text" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Sirname</label>
                        <input name="lname" type="text" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Email</label>
                        <input name="email" type="email" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-4  mb-3">
                        <label class="form-label">Phone Number</label>
                        <input name="phonenum" type="number" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Picture</label>
                        <input name="profile" type="file" accept=".jpg, .jpeg, .png, .webp" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Pin Code</label>
                        <input name="pincode" type="number" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Date of Birth</label>
                        <input name="dob" type="date" class="form-control shadow-none" required>
                    </div>

                    <div class="col-md-4 mb-3">
                     <label class="form-label">Gender</label>
                      <select name="gender" class="form-select" aria-label="Default select example">
                        <option selected>Select Gender </option>
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                        <option value="3">Others</option>
                      </select>
                    </div>

                    <h5 class="modal-title d-flex mb-3" ><i class="bi bi-geo-alt-fill me-2 "></i> Address Details</h5>
                   
                    <div class="col-md-6 mb-3">
                        <label class="form-label">State</label>
                        <input name="state" type="text" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Country</label>
                        <input name="country" type="text" class="form-control shadow-none" required>
                    </div>
                    <!-- Address details -->
                        
                    <div id="addressFields">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Address line</label>
                                <textarea name="address" class="form-control shadow-none" rows="1" required></textarea>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="user_id">
    
    
                </div>
            </div>
            <div class="text-center my-1">
            <button type="submit" class="btn btn-dark shodow-none">Submit </button> 
            </div>
            
        </div>
        </form>
        </div>
        </div>
</div>


<h6 class="text-center bg-dark text-white p-3 m-0">Designed and Developed By Siddesh</h6>













<script src="scripts/add.js"></script>

</body>
</html>

