{include file='common/header.tpl'}
{literal}
function getStatus(){
      var data;
{/literal}
      data={$items}
{literal}
    reportFamousMusic(data);
    }
  </script>
  <script>
  $(document).ready(function() {
    getStatus();


   /* $('#notificationsBody ul').bind('scroll', function() {
        if($(this).scrollTop() + $(this).innerHeight() >= this.scrollHeight) {
          var id=$(this).find('li:last').attr("id");
          moreNotify(id.substring(4));
        }
    });*/

  });
  </script>
 {/literal}
</head>
<body>
      <div id="container"></div>
</body>
</html>