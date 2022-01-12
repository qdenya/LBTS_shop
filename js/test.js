window.onload = function() {
  const btnContainer = document.querySelector('.checkout-order-status-btn-container');
  const payContainer = document.querySelector('.order-payment-container');

  function GET(key, type) {
    var p = window.location.search;
    var reg = new RegExp(key + '=([^&=]+)', 'g');
    var match = reg.exec(p);
    if(type=='btn') {
      while (match != null) {
        console.log(match[1]);
        btnContainer.insertAdjacentHTML('beforeend', `<a class="btn btn-checkout-order-status btn-md rounded-pill" href="https://site.lbts.by/receipts/`+ match[1] + `.pdf">Открыть чек</a>`);
        match = reg.exec(p);
      }
    } else {
      
      while (match != null) {
        console.log(match[1]);
        payContainer.insertAdjacentHTML('beforeend', `<a class="btn" href="https://site.lbts.by/receipts/`+ match[1] + `.pdf">Открыть чек</a>`);
        match = reg.exec(p);
      }
      payContainer.style.textAlign = "center";
    }
    
    return p ? p[1] : false;
  }

  if(btnContainer) {
    GET('uid', 'btn');
  } else if(payContainer) {
    GET('uid', 'pay');
  }

};
