window.onscroll = function() {scrollFunction()};

function scrollFunction() {
if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
    document.getElementById("shrink1").style.display = 'none';
    document.getElementById("shrink2").innerHTML = "";
} else {
    document.getElementById("shrink1").style.display = 'block';
    document.getElementById("shrink2").innerHTML = "Gaming Store";
}
}


function openModal(productId) {
    const modal = document.getElementById('editModal' + productId);
    modal.showModal();
  }


  function closeModal(productId) {
    document.getElementById('editModal' + productId).close(); 
  }