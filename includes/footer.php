    <div class="m-t-100"><strong>&copy; Développé avec  <i class="fas fa-heart" style="color:red"></i>  par <a href="https://github.com/YannMCX" target="_blank" rel="noopener noreferrer">Yann</a>, <a href="https://github.com/ThibaultJamin" target="_blank" rel="noopener noreferrer">Thibault</a> et <a href="https://github.com/MathieuFlick" target="_blank" rel="noopener noreferrer">Mathieu</a></strong></div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js" integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/js/i18n/defaults-fr_FR.min.js"></script>
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $('[data-toggle="tooltip"]').tooltip();
              $('[data-toggle="popover"]').popover();
            $(document).on('click', '.clickable-row', function() {
                window.location = $(this).data("href");
            });
            fetch('./resources/content/display-table.php').then((response) => {
                return response.text()
            }).then((data) => {
                $('#listing-content').html(data);
            })
            $('.listing-display span').click(function() {
                $(this).addClass('active').siblings().removeClass('active');
                let displayMode = $(this).data('display');
                if(displayMode === 'table') {
                    fetch('./resources/content/display-table.php').then((response) => {
                        return response.text()
                    }).then((data) => {
                        $('#listing-content').html(data).addClass('animated fadeIn');
                    })
                } else if(displayMode === 'items') {
                    fetch('./resources/content/display-items.php').then((response) => {
                        return response.text()
                    }).then((data) => {
                        $('#listing-content').html(data).addClass('animated fadeIn');
                    })
                }
           });
        });
    </script>
</body>
</html>