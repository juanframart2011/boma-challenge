// Delete Account Notification
document.querySelector('.btn-delete-account').addEventListener('click', function() {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e7515a',
        cancelButtonColor: '#3b3f5c',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Deleted!',
            'Your account has been deleted.',
            'success'
            )
        }
    })
})


// Selectable Dropdown
function selectableDropdown(getElement, myCallback) {
    var getDropdownElement = getElement;
    for (var i = 0; i < getDropdownElement.length; i++) {
        getDropdownElement[i].addEventListener('click', function() {
            
            var dataValue = this.getAttribute('data-value');
          var dataImage = this.getAttribute('data-img-value');
          
          if(dataValue === null && dataImage === null) {
              console.warn('No attributes are defined. Kindly define one attribute atleast')
          }
          
          if (dataValue != '' && dataValue != null) {
              this.parentElement.parentNode.querySelector('.dropdown-toggle > .selectable-text').innerText = dataValue;
            }
            
            if (dataImage != '' && dataImage != null) {
            this.parentElement.parentNode.querySelector('.dropdown-toggle > img').setAttribute('src', dataImage );
        }
        
    })
    }
}

selectableDropdown(document.querySelectorAll('.cardName-select .dropdown-item'));