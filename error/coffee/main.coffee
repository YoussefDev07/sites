new WOW().init();

window.onload = ->

  # error

  home = document.getElementById("home")
  reload = document.getElementById("reload")
  discord = document.getElementById("discord")

  home?.onclick = ->
    window.location.replace "http://localhost/www/Space%20Sites%E2%84%A2"

  reload?.onclick = ->
    window.location.reload()

  discord?.onclick = ->
    window.location.assign ""