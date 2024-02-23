
//script to extra address link
    let newIndex = 1;
    
        function addAddressLine() {
            var container = document.getElementById("addressFields");
            var addressLines = container.getElementsByClassName("row");
            if (addressLines.length < 5) {
                 // Check if the maximum limit has not been reached
                
                var addressLine = document.createElement("div");
                addressLine.classList.add("row", "mb-3");
                addressLine.innerHTML = `
                    <div class="col-md-12">
                        <label class="form-label">Address line ${newIndex}</label>
                        <textarea name="address_${newIndex}" class="form-control shadow-none" rows="1" required></textarea>
                    </div>
                `;
                
                container.appendChild(addressLine);
                newIndex++;
            } else {
                alert('error',"You have reached the maximum limit of address lines.",'image-alert');
            }
        }

        // Function to remove the last added address line
        function removeAddressLine() {
            var container = document.getElementById("addressFields");
            var addressLines = container.getElementsByClassName("row");
            if (addressLines.length > 1) {
                container.removeChild(addressLines[addressLines.length - 1]);
            }
            newIndex--;
        }


//script to add form
let add_form = document.getElementById('add-form');

add_form.addEventListener('submit',(e)=>{
    e.preventDefault();

 let data= new FormData();
 data.append('name',add_form.elements['name'].value);
 data.append('mname',add_form.elements['mname'].value);
 data.append('lname',add_form.elements['lname'].value);
 data.append('gender',add_form.elements['gender'].value);
 data.append('email',add_form.elements['email'].value);
 data.append('phonenum',add_form.elements['phonenum'].value);
 data.append('profile',add_form.elements['profile'].value);
 data.append('pincode',add_form.elements['pincode'].value);
 data.append('dob',add_form.elements['dob'].value);
 data.append('state',add_form.elements['state'].value);
 data.append('country',add_form.elements['country'].value);
 data.append('address',add_form.elements['address'].value);

 
 for (let i = 1; i < 5; i++) {
    if (add_form.elements['address_' + i]) {
        data.append('address_' + i, add_form.elements['address_' + i].value);
    }
}

 data.append('add','');

 var myModal = document.getElementById('AddModel');
 var modal = bootstrap.Modal.getInstance(myModal); // Returns a Bootstrap modal instance
 modal.hide();

 let xhr = new XMLHttpRequest();

 xhr.open('POST','ajax/getall.php',true);

 xhr.onload = function(){


    if(this.responseText == 'ins_failed')
    {
        alert('error',"Cannot add!");
        add_form.reset();
    }
    else if(this.responseText == 'email_already')
    {
        alert('error',"Email already exists");
    }
    else (this.responseText == 'inserted')
    {
        alert('success',"added succesfully");
        add_form.reset();
        get_users();
    }


 }

 xhr.send(data);

});


//customize alert function
function alert(type,msg,position='body')
{
let bs_class=(type == 'success') ? 'alert-success' : 'alert-danger';
let element = document.createElement('div');
element.innerHTML= `
<div class="alert ${bs_class} alert-dismissible fade show" role="alert">
<strong>${msg}</strong>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
`;

if( position =='body')
{
    document.body.append(element);
    element.classList.add('custom-alert');

}
else{
    document.getElementById(position).appendChild(element);
}
setTimeout(remAlert,2000);

}
function remAlert()
{
document.getElementsByClassName('alert')[0].remove();
}

//pagination change page
function change_page(page)
{
  get_users(document.getElementById('search_input').value,page);
}

//loading all user 
function get_users(search='',page=1)
{
let xhr = new XMLHttpRequest();

xhr.open('POST','ajax/getall.php',true);

xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

xhr.onload = function()
{ 
    let data=JSON.parse(this.responseText);
   document.getElementById('table-data').innerHTML=data.table_data;  
   document.getElementById('table-pagination').innerHTML=data.pagination;        
}

xhr.send('get_users&search='+search+'&page='+page);
}

//update/edit userr



let edit_form =document.getElementById('edit-form');

function edit_details(id)
{
  
  let xhr = new XMLHttpRequest();

  xhr.open('POST','ajax/getall.php',true);
  xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
  xhr.onload = function(){
   
     let data=JSON.parse(this.responseText);

    edit_form.elements['name'].value= data.userdata.fname;
    edit_form.elements['mname'].value= data.userdata.mname;
    edit_form.elements['lname'].value= data.userdata.lname;
    edit_form.elements['gender'].value= data.userdata.gender;
    edit_form.elements['email'].value= data.userdata.mail;
    edit_form.elements['phonenum'].value= data.userdata.contact; 
   
    edit_form.elements['pincode'].value= data.addata.pincode;
    edit_form.elements['dob'].value= data.userdata.dob;
    edit_form.elements['pincode'].value= data.addata.pincode;
    edit_form.elements['state'].value= data.addata.state;
    edit_form.elements['country'].value= data.addata.country;
    edit_form.elements['address'].value= data.addata.address;
    edit_form.elements['user_id'].value= data.userdata.eid;
  

    if (data.userdata.gender === 'Male') {
        edit_form.elements['gender'].selectedIndex = 1; 
      } else if (data.userdata.gender === 'Female') {
        edit_form.elements['gender'].selectedIndex = 2; 
      }
      else{
        edit_form.elements['gender'].selectedIndex = 3;
      }
      edit_form.elements['profile'].value= '';

  }
  xhr.send('get_user='+id);

}

edit_form.addEventListener('submit',(e)=>{
    e.preventDefault();
    submit_edit();
});



function submit_edit()
{
    
 let data= new FormData();
 data.append('name',edit_form.elements['name'].value);
 data.append('mname',edit_form.elements['mname'].value);
 data.append('lname',edit_form.elements['lname'].value);
 data.append('gender',edit_form.elements['gender'].value);
 data.append('email',edit_form.elements['email'].value);
 data.append('phonenum',edit_form.elements['phonenum'].value);
 data.append('profile',edit_form.elements['profile'].value);
 data.append('pincode',edit_form.elements['pincode'].value);
 data.append('dob',edit_form.elements['dob'].value);
 data.append('state',edit_form.elements['state'].value);
 data.append('country',edit_form.elements['country'].value);
 data.append('address',edit_form.elements['address'].value);
 data.append('user_id',edit_form.elements['user_id'].value);
 data.append('edit','');

 var myModal = document.getElementById('editModel');
 var modal = bootstrap.Modal.getInstance(myModal); // Returns a Bootstrap modal instance
 modal.hide();

 let xhr = new XMLHttpRequest();

 xhr.open('POST','ajax/getall.php',true);

 xhr.onload = function(){

    console.log(this.responseText);

    if(this.responseText == 1)
    {
        alert('success',"Updated");

        edit_form.reset();
        get_users();
    }
    else 
    {
        alert('error',"Error Occured");
    }


 }

 xhr.send(data);

}


function delete_user(id)
{
  let xhr = new XMLHttpRequest();

  xhr.open('POST','ajax/getall.php',true);

  xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

  xhr.onload = function(){
  if(this.responseText==1)
  {
    alert('success','Employee Removed.!');
    get_users();
  }
  else{
    alert('error','Server down');
  }
    
  }
  xhr.send('del_user='+id);
}




//window load
window.onload=function(){
  get_users();
 }
