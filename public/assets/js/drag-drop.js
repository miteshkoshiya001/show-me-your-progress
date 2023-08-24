// === Define Variables and Elements ===
var elements = document.querySelectorAll('.box .catItem');
var targetEl;
var wrapper = document.getElementById("box");
var catItemClip = document.getElementById("catItemClip");

var scopeObj;

// === Event Binding ===
for (var i = 0, max = elements.length; i < max; i++) {
  elements[i].addEventListener("dragstart", handleDrag);
  elements[i].addEventListener("dragend", handleDragEnd);
  elements[i].addEventListener("dragenter", handleDragEnter);

  elements[i].addEventListener("touchstart", handleTouch);
  elements[i].addEventListener("touchend", handleTouchEnd);
  elements[i].addEventListener("touchmove", handleTouchMove);
}

// === Function Kits ===
function handleDrag(event) {
  targetEl = event.target;
  targetEl.classList.add("onDrag");

}

function handleDragEnd(event) {
  console.log(targetEl);
  targetEl.classList.remove("onDrag");
  collectOrderData();

}

function handleDragEnter(event) {
  console.log(wrapper);
  console.log(wrapper);

  wrapper.insertBefore(targetEl, event.target);
}

function handleTouch(event) {
  defineScope(elements);
  targetEl = event.target;
  catItemClip.style.top = event.changedTouches[0].clientY + "px";
  catItemClip.style.left = event.changedTouches[0].clientX + "px";
  catItemClip.innerText = event.target.innerText;
  catItemClip.classList.remove("hide");
  targetEl.classList.add("onDrag");
}

function handleTouchEnd(event) {
  catItemClip.classList.add("hide");
  targetEl.classList.remove("onDrag");
  collectOrderData();
}

function handleTouchMove(event) {
  catItemClip.style.top = event.changedTouches[0].clientY + "px";
  catItemClip.style.left = event.changedTouches[0].clientX + "px";
  hitTest(event.changedTouches[0].clientX, event.changedTouches[0].clientY);
}

function hitTest(thisX, thisY) {

  for (var i = 0, max = scopeObj.length; i < max; i++) {
    if (thisX > scopeObj[i].startX && thisX < scopeObj[i].endX) {
      if (thisY > scopeObj[i].startY && thisY < scopeObj[i].endY) {
        wrapper.insertBefore(targetEl, scopeObj[i].target);
        return;
      }
    }
  }
}

function defineScope(elementArray) {
  console.log(elementArray);
  scopeObj = [];
  for (var i = 0, max = elementArray.length; i < max; i++) {
    var newObj = {};
    newObj.target = elementArray[i];
    newObj.startX = elementArray[i].offsetLeft;
    newObj.endX = elementArray[i].offsetLeft + elementArray[i].offsetWidth;
    newObj.startY = elementArray[i].offsetTop;
    newObj.endY = elementArray[i].offsetTop + elementArray[i].offsetHeight;
    console.log(newObj);
    scopeObj.push(newObj);
  }
}

var order = [];
function collectOrderData() {
  order = [];
  $('.data-index').each(function (index, element) {
    var rowData = $(element).data('id');
    if (rowData) {
      order.push({
        id: rowData,
        position: index + 1
      });
    }
  });


  order.sort(function (a, b) {
    return a.position - b.position;
  });

  sendOrderToServer();
}