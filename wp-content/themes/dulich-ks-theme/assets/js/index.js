document.addEventListener('DOMContentLoaded', function() {
    var backToTopButton = document.getElementById('back-to-top');
  
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 200) {
            backToTopButton.style.display = 'block';
        } else {
            backToTopButton.style.display = 'none';
        }
    });

    backToTopButton.addEventListener('click', function(e) {
        e.preventDefault();
        var scrollOptions = {
            top: 0,
            behavior: 'smooth'
        };
        window.scrollTo(scrollOptions);
    });
});
// xu ly menu tablet mobile
function openNav() {
    document.getElementById("menu-mb").style.width = "250px";
  }
  
  function closeNav() {
    document.getElementById("menu-mb").style.width = "0";
  }