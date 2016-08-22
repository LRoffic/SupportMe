$(function (){
  if (NodeList.prototype.forEach === undefined) {
    NodeList.prototype.forEach = function (callback) {
      [].forEach.call(this, callback)
    }
  }

  let terms = [{
    time: 45,
    divide: 60,
    text: lang.js.agoOneMinute
  }, {
    time: 90,
    divide: 60,
    text: lang.js.aboutAMinute
  }, {
    time: 45 * 60,
    divide: 60,
    text: '%d ' + lang.js.minute
  }, {
    time: 90 * 60,
    divide: 60 * 60,
    text: lang.js.aboutAnHour
  }, {
    time: 24 * 60 * 60,
    divide: 60 * 60,
    text: '%d ' + lang.js.hour
  }, {
    time: 42 * 60 * 60,
    divide: 24 * 60 * 60,
    text: lang.js.aboutADay
  }, {
    time: 30 * 24 * 60 * 60,
    divide: 24 * 60 * 60,
    text: '%d ' + lang.js.day
  }, {
    time: 45 * 24 * 60 * 60,
    divide: 24 * 60 * 60 * 30,
    text: lang.js.aboutAMonth
  }, {
    time: 365 * 24 * 60 * 60,
    divide: 24 * 60 * 60 * 30,
    text: '%d ' + lang.js.month
  }, {
    time: 365 * 1.5 * 24 * 60 * 60,
    divide: 24 * 60 * 60 * 365,
    text: lang.js.aboutAYear
  }, {
    time: Infinity,
    divide: 24 * 60 * 60 * 365,
    text: '%d ' + lang.js.year
  }]

  document.querySelectorAll('[data-ago]').forEach(function (node) {

    let date = parseInt(node.dataset.ago, 10)

    function setText () {
      let secondes = Math.floor((new Date()).getTime() / 1000 - date)
      let prefix = secondes > 0 ? lang.js.ago : lang.js.in
      let term = null
      secondes = Math.abs(secondes)
      for (term of terms) {
        if (secondes < term.time) {
          break
        }
      }
      node.innerHTML = prefix + term.text.replace('%d', Math.round(secondes / term.divide))

      let nextTick = secondes % term.divide
      if (nextTick === 0) {
        nextTick = term.divide
      }

      window.setTimeout(function () {
        if (node.parentNode) {
          if (window.requestAnimationFrame) {
            window.requestAnimationFrame(setText)
          } else {
            setText()
          }
        }
      }, nextTick * 1000)
    }

    setText()
  })
})