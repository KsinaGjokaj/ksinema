const x = document.getElementById("nav-bar")
const y = document.getElementById("container2")
const mobile = (screen.width) < 540


if (mobile) {
    x.classList.add('hidden')
    y.classList.add('block')
} else {
    x.classList.add('block')
    y.classList.add('block')
}

function myFunction() {
    console.log("Resolution width: " + screen.width)
    if (mobile && x.classList.contains('block')) {
        x.classList.remove('block')
        x.classList.add('hidden')
        y.classList.remove('hidden')
        y.classList.add('block')

    } else if (mobile && x.classList.contains('hidden')) {
        y.classList.remove('block')
        y.classList.add('hidden')
        x.classList.remove('hidden')
        x.classList.add('block')
    }

    if (x.classList.contains('block') && !mobile) {
        x.classList.add('hidden')
        x.classList.remove('block')

    } else if (!mobile) {
        x.classList.remove('hidden')
        x.classList.add('block')

    }
}
