$( document ).ready(function worker() {
  $.ajax({
    url: './statistics/alltimestatistics.php',
    success: function(data) {
      $('.allTimeStatistiscs').html(data);
    },
    complete: function() {
      // Schedule the next request when the current one's complete
      setTimeout(worker, 5000);
    }
  });
});

$( document ).ready(function worker() {
  $.ajax({
    url: './statistics/cocktailstatistics.php',
    success: function(data) {
      $('.cocktailStatistics').html(data);
    },
    complete: function() {
      // Schedule the next request when the current one's complete
      setTimeout(worker, 5000);
    }
  });
});

$( document ).ready(function worker() {
  $.ajax({
    url: './statistics/daystatistics.php',
    success: function(data) {
      $('.dayStatistics').html(data);
    },
    complete: function() {
      // Schedule the next request when the current one's complete
      setTimeout(worker, 5000);
    }
  });
});
