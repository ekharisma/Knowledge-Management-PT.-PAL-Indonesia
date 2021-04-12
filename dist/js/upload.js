const category = document.getElementById('kategori');
const subCategory_1 = document.getElementById('sub1_kategori');
const subCategory_2 = document.getElementById('sub2_kategori');
const subCategory_3 = document.getElementById('sub3_kategori');
const subCategory_4 = document.getElementById('sub4_kategori');
const xhr = new XMLHttpRequest();
const UPLOADHELPER = '../helper/Upload.php';

category.addEventListener('change', () => {
    let value = category.value;
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            subCategory_1.innerHTML = this.response;
            console.log(this.response);
        }
    };
    xhr.open("GET", UPLOADHELPER + "?kategori=" + value, true);
    xhr.send();
});

subCategory_1.addEventListener('change', () => {
    let value = subCategory_1.value;
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            subCategory_2.innerHTML = this.response;
            console.log(this.response);
        }
    };
    xhr.open("GET", UPLOADHELPER + "?subkategori1=" + value, true);
    xhr.send();
});

subCategory_2.addEventListener('click', () => {
    let value = subCategory_2.value;
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            subCategory_3.innerHTML = this.response;
            console.log(this.response);
        }
    };
    xhr.open("GET", UPLOADHELPER + "?subkategori2=" + value, true);
    xhr.send();
});

subCategory_3.addEventListener('change', () => {
    let value = subCategory_3.value;
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            subCategory_4.innerHTML = this.response;
            console.log(this.response);
        }
    };
    xhr.open("GET", UPLOADHELPER + "?subkategori3=" + value, true);
    xhr.send();
});
