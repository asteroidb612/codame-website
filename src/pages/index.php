<?
  include('admin/functions.php');
?>
<html>
<? include('partials/head.php') ?>
<body>

  <? include('partials/header.php') ?>
  <? include('partials/sidebar.php') ?>
  
  <div id="content">

    <!-- EVENTS -->

    <section class="column" id="events">
      <a href="<? echo $site_url; ?>/events" class="bar-link">
        <h2>
          Events
        </h2>
      </a>

      <div class='inner-column'>
        <? output_results('events',0,0,'blocks','date'); ?>
      </div>

    </section>

    <!-- PROJECTS -->

    <section class="column" id='projects'>
      <a href="<? echo $site_url; ?>/projects" class="bar-link">
        <h2>
          Projects
        </h2>
      </a>
      <div class='inner-column'>
        <? output_results('projects',0,0,'blocks','edited'); ?>
      </div>
    </section>

  </div>
  <? include('partials/footer.php') ?>

</body>
</html>