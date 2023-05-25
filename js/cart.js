
function increaseValue(id) {
    var inputElement = document.getElementById(id);
    // Lấy giá trị hiện tại và chuyển đổi thành số nguyên
    var currentValue = parseInt(inputElement.value);
    var newValue = currentValue + 1;
    inputElement.value = newValue;
     
    // update lại số lượng trong giỏ hàng
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/views/Cart/updateCart.php', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log("Dữ liệu đã được gửi thành công.");
                console.log(xhr.responseText); // Phản hồi từ updateCart.php
            } else {
                console.error("Lỗi khi gửi dữ liệu:", xhr.status);
            }
        }
    };
    const idproduct = id.split('-')[1];
    xhr.send("id=" + idproduct + "&quantity=" + newValue);
    //tách số ra khỏi chuỗi
    
    var req = new XMLHttpRequest();
    req.open("GET", "/database/api/getData.php?fields=product&id=" + idproduct+"&price=true", true);
    req.send();
    req.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            var price = parseInt(data.price);
            var total = price * newValue;
            document.getElementById("price-" + id).innerHTML = "Đơn giá: " + total + "đ";
        }
    }
}

function decreaseValue(id) {
    var inputElement = document.getElementById(id);
    // Lấy giá trị hiện tại và chuyển đổi thành số nguyên
    var currentValue = parseInt(inputElement.value);
    var newValue = currentValue - 1;
    if (newValue >= 1) {
        inputElement.value = newValue;
    } 
    else {
        inputElement.value = 1;
        newValue = 1;
    }
    // update lại số lượng trong giỏ hàng
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/views/Cart/updateCart.php', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log("Dữ liệu đã được gửi thành công.");
                console.log(xhr.responseText); // Phản hồi từ updateCart.php
            } else {
                console.error("Lỗi khi gửi dữ liệu:", xhr.status);
            }
        }
    };
    const idproduct = id.split('-')[1];
    xhr.send("id=" + idproduct + "&quantity=" + newValue);

    var req = new XMLHttpRequest(); 
    req.open("GET", "/database/api/getData.php?fields=product&id=" + idproduct +"&price=true", true);
    req.send();
    req.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            // chuyển đổi dữ liệu từ chuỗi sang json
            var data = JSON.parse(this.responseText);
            var price = parseInt(data.price);
            var total = price * newValue;
            document.getElementById("price-" + id).innerHTML = "Đơn giá: " + total + "đ";
        }
    }
}
function addCart(getId) {
    if (document.getElementById('logout') == null) {
      window.location.href = "/auth/Login/index.php";
  
    } else {
      var linkElement = document.getElementById(getId);
      // nếu không có id logout thì sẽ chuyển hướng đến trang đăng nhập
      var id = linkElement.getAttribute('data-id');
      var name = linkElement.getAttribute('data-name');
      var price = linkElement.getAttribute('data-price');
      var image = linkElement.getAttribute('data-image');
      var quantity = linkElement.getAttribute('data-quantity');
  
      var xhr = new XMLHttpRequest();
      xhr.open('POST', '/views/Cart/addCart.php', true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            console.log("Dữ liệu đã được gửi thành công.");
            console.log(xhr.responseText); // Phản hồi từ addCart.php
            const alert = document.querySelector('.alert-popup');
            alert.innerHTML = 'Đã thêm ' + name + ' vào giỏ hàng';
            alert.style.display = 'flex';
            setTimeout(function () {
              alert.style.display = 'none';
            }, 3000);
          } else {
            console.error("Lỗi khi gửi dữ liệu:", xhr.status);
          }
        }
      };
  
      xhr.send("id=" + id + "&name=" + name + "&price=" + price + "&image=" + image + "&quantity=" + quantity);
    }
    const cart = document.querySelector('.count-cart');
    if (cart.innerHTML == '') {
      cart.innerHTML = 1;
    } else {
      var req = new XMLHttpRequest();
      req.open('GET', '/views/Cart/countCart.php', true);
      req.send();
      req.onload = () => {
        const json = JSON.parse(req.responseText);
        cart.innerHTML = json.countCart;
      }
    }
  }
function deleteProduct (id) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/views/Cart/deleteCart.php', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log("Dữ liệu đã được gửi thành công.");
                console.log(xhr.responseText); // Phản hồi từ updateCart.php
                window.location.reload();
            } else {
                console.error("Lỗi khi gửi dữ liệu:", xhr.status);
            }
        }
    };
    xhr.send("id=" + id);
}