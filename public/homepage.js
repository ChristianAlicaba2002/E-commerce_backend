const imagessss = document.getElementById("imagessss");
const message = document.getElementById("message");

let nameofFile = "";
document.querySelector('input[type="file"]').addEventListener('change',function(){
   
    if(this.files && this.files[0]){
        var img = document.querySelector('img');

        img.onload =()=>{
            URL.revokeObjectURL(img.src);
        }
        img.src = URL.createObjectURL(this.files[0]);
        console.log(this.files[0]);
        imagessss.style.display = "inline-block"
        subimage.style.display = "none"
        imagelabel.textContent = this.files[0].name
    };

    const getfilename = (event) => {
        const files = event.target.files;
        const fileName = files[0].name;
        nameofFile = fileName;
        console.log("file name: ",getfilename)
    }
}); 


document.getElementById('productForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const name = document.querySelector('input[name="name"]');
    const price = document.querySelector('input[name="price"]');
    const image = document.querySelector('input[name="image"]');
    
    const inputs = [name, price,image];
    inputs.forEach(input => {
        input.classList.remove('is-invalid');
        const feedback = input.nextElementSibling;
        if (feedback && feedback.classList.contains('invalid-feedback')) {
            feedback.remove();
        }
    });
    let isValid = true;
    
    if (!name.value.trim()) {
        showError(name, 'Product name is required');
        isValid = false;
    }
    
    if (!price.value.trim()) {
        showError(price, 'Price is required');
        isValid = false;
    } else if (price.value <= 0) {
        showError(price, 'Price must be greater than 0');
        isValid = false;
    }
    
    if (!image.files || !image.files[0]) {
        showError(image, 'Please select an image');
        isValid = false;
    }

    if (isValid) {
        this.submit();
    }
});

function showError(input, message) {
    input.classList.add('is-invalid');
    const errorDiv = document.createElement('div');
    errorDiv.className = 'invalid-feedback';
    errorDiv.textContent = message;
    input.parentNode.insertBefore(errorDiv, input.nextSibling);
}

document.getElementById('images').onchange = function(evt) {
    const [file] = this.files;
    if (file) {
        document.getElementById('imagessss').src = URL.createObjectURL(file);
    }
};