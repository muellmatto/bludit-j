"use strict";

function getImageList() {
    var tmp = document.getElementsByTagName('img');
    var images = [];
    for (var i=0; i < tmp.length; i++)  {
        images.push(tmp[i].src);
    }
    return images;
}

function shiftListNTimes(list,n) {
    for(var i=0; i<n; i++){
        list.push(list.shift());
    }
    return list
}

function createLightboxFunction(i) {
    var list = getImageList();
    list = shiftListNTimes(list,i);
    console.log('list ' + i.toString() +':');
    console.log(list);
    var options = {"items": list};
    return function()   {
                            $.SimpleLightbox.open(options);
                        }
}

function addOnClickLightbox() {
    var tmp = document.getElementsByTagName('img');
    for (var i=0; i < tmp.length; i++)  {
        tmp[i].onclick = createLightboxFunction(i);
    }
}


// addOnClickYalb();
