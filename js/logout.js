function logout() {
    const req = new XMLHttpRequest();
    req.open("POST", "/Auth/logout.php", true);
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.onreadystatechange = () => {
      if (req.readyState === XMLHttpRequest.DONE && req.status === 200) {
        window.location.replace("/index.php");
      }
    };
    req.send();
  }
  