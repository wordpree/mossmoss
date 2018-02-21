            
                <span id="ct_search_icon"></span>
                <form role="search" method="get" class="ct-search-form ct-hidden" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <?php
                    printf( '<input type="search" class="ct-search-field" placeholder="%1$s" value="%2$s" name="s" title="%3$s" />',
                        esc_attr_x( 'Search &hellip;', 'placeholder', 'acool' ),
                        get_search_query(),
                        esc_attr_x( 'Search for:', 'label', 'acool' )
                    );
                ?>
                </form>
