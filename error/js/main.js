new WOW().init();

window.onload = function() {
  var discord, home, reload;
  // error
  home = document.getElementById("home");
  reload = document.getElementById("reload");
  discord = document.getElementById("discord");
  if (home != null) {
    home.onclick = function() {
      return window.location.replace("http://localhost/www/Space%20Sites%E2%84%A2");
    };
  }
  if (reload != null) {
    reload.onclick = function() {
      return window.location.reload();
    };
  }
  return discord != null ? discord.onclick = function() {
    return window.location.assign("");
  } : void 0;
};
