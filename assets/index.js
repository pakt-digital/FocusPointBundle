import { FocusPicker } from "image-focus"
import "./style.scss"

alert('hi');

document
  .querySelectorAll(".js-focus-picker")
  .forEach(picker => {
    let area = picker.querySelector("img");

    if (!area) {
      return;
    }

    let x = picker.querySelectorAll('input[type="hidden"]')[0];
    let y = picker.querySelectorAll('input[type="hidden"]')[1];

    new FocusPicker(area, {
      onChange: (focus) => {
        x.value = focus.x;
        y.value = focus.y;
      },
      focus: {
        x: x.value,
        y: y.value
      }
    })
  })


