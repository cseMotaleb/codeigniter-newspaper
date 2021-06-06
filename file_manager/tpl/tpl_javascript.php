<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.rightClick.js" type="text/javascript"></script>
<script src="js/jquery.drag.js" type="text/javascript"></script>
<script src="js/helper.js" type="text/javascript"></script>
<script src="js/browser/joiner.php" type="text/javascript"></script>
<script src="js_localize.php?lng=<?= $this->lang ?>" type="text/javascript"></script>
<?php IF (isset($this->opener['TinyMCE']) && $this->opener['TinyMCE']): ?>
<script src="<?= $this->config['_tinyMCEPath'] ?>/tiny_mce_popup.js" type="text/javascript"></script>
<?php ENDIF ?>
<?php IF (file_exists("themes/{$this->config['theme']}/init.js")): ?>
<script src="themes/<?= $this->config['theme'] ?>/init.js" type="text/javascript"></script>
<?php ENDIF ?>
<script type="text/javascript">
browser.version = "<?= self::VERSION ?>";
browser.support.chromeFrame = <?= (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), " chromeframe") !== false) ? "true" : "false" ?>;
browser.support.zip = <?= (class_exists('ZipArchive') && !$this->config['denyZipDownload']) ? "true" : "false" ?>;
browser.support.check4Update = <?= ((!isset($this->config['denyUpdateCheck']) || !$this->config['denyUpdateCheck']) && (ini_get("allow_url_fopen") || function_exists("http_get") || function_exists("curl_init") || function_exists('socket_create'))) ? "true" : "false" ?>;
browser.lang = "<?= text::jsValue($this->lang) ?>";
browser.type = "<?= text::jsValue($this->type) ?>";
browser.theme = "<?= text::jsValue($this->config['theme']) ?>";
browser.access = <?= json_encode($this->config['access']) ?>;
browser.dir = "<?= text::jsValue($this->session['dir']) ?>";
browser.uploadURL = "<?= text::jsValue($this->config['uploadURL']) ?>";
browser.thumbsURL = browser.uploadURL + "/<?= text::jsValue($this->config['thumbsDir']) ?>";
<?php IF (isset($this->get['opener']) && strlen($this->get['opener'])): ?>
browser.opener.name = "<?= text::jsValue($this->get['opener']) ?>";
<?php ENDIF ?>
<?php IF (isset($this->opener['CKEditor']['funcNum']) && preg_match('/^\d+$/', $this->opener['CKEditor']['funcNum'])): ?>
browser.opener.CKEditor = {};
browser.opener.CKEditor.funcNum = <?= $this->opener['CKEditor']['funcNum'] ?>;
<?php ENDIF ?>
<?php IF (isset($this->opener['TinyMCE']) && $this->opener['TinyMCE']): ?>
browser.opener.TinyMCE = true;
<?php ENDIF ?>
browser.cms = "<?= text::jsValue($this->cms) ?>";
_.kuki.domain = "<?= text::jsValue($this->config['cookieDomain']) ?>";
_.kuki.path = "<?= text::jsValue($this->config['cookiePath']) ?>";
_.kuki.prefix = "<?= text::jsValue($this->config['cookiePrefix']) ?>";
$(document).ready(function() {
    browser.resize();
    browser.init();
    $('#all').css('visibility', 'visible');
});
$(window).resize(browser.resize);
</script>
