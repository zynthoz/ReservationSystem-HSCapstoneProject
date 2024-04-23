
//toggle header divs
function toggleDiv(divId, buttonId) {
  var divs = document.getElementsByClassName("divs");
  for (var i = 0; i < divs.length; i++) {
    divs[i].style.display = "none";
  }
  document.getElementById(divId).style.display = "flex";
  var buttons = document.getElementsByTagName("button");
  for (var i = 0; i < buttons.length; i++) {
    buttons[i].classList.remove("active");
  }
  document.getElementById(buttonId).classList.add("active");
}
//toggle border for header
const buttons = document.querySelectorAll('.borderless-button');

buttons.forEach(button => {
  button.addEventListener('click', () => {
    buttons.forEach(inactiveButton => {
      inactiveButton.classList.remove('active-button');
      inactiveButton.classList.add('inactive-button');
    });
    button.classList.remove('inactive-button');
    button.classList.add('active-button');
  });
});

// window.onload = function() {
//   let gradeOptions = document.querySelectorAll('option[data-group="grade"]');
//   let highOptions = document.querySelectorAll('option[data-group="high"]');

//   document.getElementById('grade').addEventListener('change', function() {
//     gradeOptions.forEach(function(option) {
//       option.style.display = 'block';
//     });
//     highOptions.forEach(function(option) {
//       option.style.display = 'none';
//     });
//   });

//   document.getElementById('high').addEventListener('change', function() {
//     highOptions.forEach(function(option) {
//       option.style.display = 'block';
//     });
//     gradeOptions.forEach(function(option) {
//       option.style.display = 'none';
//     });
//   });

//   // Hide all options initially
//   gradeOptions.forEach(function(option) {
//     option.style.display = 'none';
//   });
//   highOptions.forEach(function(option) {
//     option.style.display = 'none';
//   });

//   // Show options for the initially selected radio button
//   document.querySelector('input[name="level"]:checked').addEventListener('change', function() {
//     if (this.value === 'grade') {
//       gradeOptions.forEach(function(option) {
//         option.style.display = 'block';
//       });
//       highOptions.forEach(function(option) {
//         option.style.display = 'none';
//       });
//     } else if (this.value === 'high') {
//       highOptions.forEach(function(option) {
//         option.style.display = 'block';
//       });
//       gradeOptions.forEach(function(option) {
//         option.style.display = 'none';
//       });
//     }
//   });
// }
