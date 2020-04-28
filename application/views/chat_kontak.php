

                  <!-- Contacts are loaded here -->
                  <div class='direct-chat-contacts'>
                    <ul class='contacts-list'>
                  <?php 
                    
                    foreach ($list_chat->result() as $chat) {
                      echo "

                      <li>
                        <a href='#'>
                          <img class='contacts-list-img' src='".base_url()."dist/img/avatar2.png' alt='User Image'>

                          <div class='contacts-list-info'>
                                <span class='contacts-list-name'>
                                  $chat->nama
                                  <small class='contacts-list-date pull-right'>2/28/2015</small>
                                </span>
                            <span class='contacts-list-msg'>$chat->isi</span>
                          </div>
                          <!-- /.contacts-list-info -->
                        </a>
                      </li>
                      <!-- End Contact Item -->

                      ";
                    }
                    
                  ?>
                    </ul>
                    <!-- /.contatcts-list -->
                  </div>
                  <!-- /.direct-chat-pane -->
                