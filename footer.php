  <footer class='footer'>
    <div class='columns'>
      <div class='column'>
        <p>
          Made with &#x2665; by <a href='https://natenorthway.com' target='_blank'>Nate Northway</a><br />
          <a href='#'>Github</a><br />
          <a href='<?php echo $base; ?>privacy'>Privacy</a><br />
        </p>
      </div>
    </div>
    <script type='text/javascript'>
    document.addEventListener('DOMContentLoaded', () => {
      const menu_toggle = document.getElementById('navbar_toggle');
      if (menu_toggle) {
        console.log(menu_toggle);
        menu_toggle.addEventListener('click', (e) => {
          e.preventDefault();
          const target = document.getElementById(menu_toggle.dataset.target);
          menu_toggle.classList.toggle('is-active');
          target.classList.toggle('is-active');
        })
      }
    })
    </script>
  </footer>
  </main>
</html>
