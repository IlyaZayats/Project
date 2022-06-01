let ratingButton = document.getElementById('ratingButton');
let rating_and_offer = document.getElementById('rating_and_offer');

ratingButton.addEventListener("click", function() {
    rating_and_offer.addClass("d-none");
    rating_and_offer.removeClass("d-block");
});