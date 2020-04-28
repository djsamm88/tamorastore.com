<ul class="menu">
      <?php 
        foreach ($chat->result() as $c) {
          echo "
              <li><!-- start message -->
              <a href='".base_url()."index.php/chat/?kpd_id=$c->id_fix&kpd_nama=$c->nama'>
                <div class='pull-left'>
                  
                </div>
                <h4>
                  $c->nama
                  <small><i class='fa fa-clock-o'></i> $c->tgl</small>
                </h4>
                <p>$c->isi</p>
              </a>
            </li>
            <!-- end message -->

          ";
        }
      ?>
    </ul>