[{$smarty.block.parent}]

<hr />


<form name="myedit2" id="myedit2" action="[{$oViewConf->getSelfLink()}]" method="post" target="outputframe" style="float:left">
    <p>
        [{$oViewConf->getHiddenSid()}]
        <input type="hidden" name="cl" value="theme_main">
        <input type="hidden" name="fnc" value="webpackCompile">
        <input type="hidden" name="oxid" value="[{$oTheme->getInfo('id')}]">
        <input id="compile-btn" type="submit" value="[{oxmultilang ident="WEBPACK_COMPILE"}]">
    </p>
</form>

<form name="myedit3" id="myedit3" action="[{$oViewConf->getSelfLink()}]" method="post" target="outputframe" style="float:left">
    <p>
        [{$oViewConf->getHiddenSid()}]
        <input type="hidden" name="cl" value="theme_main">
        <input type="hidden" name="fnc" value="webpGenerate">
        <input type="hidden" name="oxid" value="[{$oTheme->getInfo('id')}]">
        <input id="webp-btn" type="submit" value="[{oxmultilang ident="WEBPACK_GENERATE_WEBP"}]">
    </p>
</form>

<iframe name="outputframe" id="outputframe" style="width:100%; height: 300px; background-color: #dddddd; border: none;"></iframe>

<script type="text/javascript">

  var scrollInterval;

  function disableButtons () {
    document.getElementById('compile-btn').disabled = true;
    document.getElementById('webp-btn').disabled = true;
    scrollInterval = setInterval(function() {
      document.getElementById('outputframe').contentWindow.scrollTo(0, 999999);
    }, 100);
  }

  function enableButtons () {
    document.getElementById('compile-btn').disabled = false;
    document.getElementById('webp-btn').disabled = false;
    document.getElementById('outputframe').contentWindow.scrollTo(0, 999999);
    clearInterval(scrollInterval);
  }

  document.getElementById('myedit2').addEventListener('submit', function() {
    disableButtons();
  });
  document.getElementById('myedit3').addEventListener('submit', function() {
    disableButtons();
  });

  document.getElementById('outputframe').addEventListener('load', function() {
    enableButtons();
  });
</script>
