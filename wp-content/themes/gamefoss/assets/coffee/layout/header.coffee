(($)->
  $(document).ready ->

    $header = $('header#header')

    search $('.search-header', $header)

    mobile $header

  # HANDLERS
  search = ( $search ) ->
    $btn = $('button', $search)
    $input = $('input', $search)

    $btn.on 'click', (e) ->
      if !$input.val().length
        e.preventDefault()
        if !$search.hasClass("opened")
          $search.addClass "opened"
          .prev().children(".socials").addClass "hide"
        else
          $search.removeClass "opened"
          .prev().children(".socials").removeClass "hide"

  mobile = ( $header ) ->
    # VARIABLAS
    $btn_open = $('.btn-menu-mobile', $header)
    $btn_close = $('.btn-close', $header)
    $mobile_menu = $('.menu-container', $header)

    # EVENTS
    $mobile_menu
    .on 'menu:open', ->
      $mobile_menu.addClass "show"
      setTimeout ->
        $mobile_menu.addClass "opened"
      , 300
    .on 'menu:close', ->
      $mobile_menu.removeClass "opened"
      setTimeout ->
        $mobile_menu.removeClass "show"
      , 300

    # LISTENERS
    $btn_open.on 'click', ->
        $mobile_menu.trigger "menu:open"

    $btn_close.on 'click', ->
      $mobile_menu.trigger "menu:close"

    $(".menu-nav", $mobile_menu).on 'click', (e) ->
      e.stopPropagation()
      $mobile_menu.trigger "menu:close";
    .on 'click', ".menu", (e) ->
      e.stopPropagation()

) (jQuery)
