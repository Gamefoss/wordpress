(($)->
  $(document).ready ->

    $header = $('header#header')

    search $('.search-header', $header)

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

) (jQuery)
