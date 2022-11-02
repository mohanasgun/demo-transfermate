<script>
    /**
     * Fetch lists of authors and books.
     *
     * @return void.
     */
    function listData() {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: '{{ route('list') }}',
            data: {
                _token: '{{ csrf_token() }}',
                input: $('#myInput').val(),
            },
            success: function(output) {
                if (output.status) {
                    let row = '';
                    $.each(output.result, function(index, value) {
                        let books = value.books.map(book => book.name)
                        row +=
                            `<tr><td>${value.name}</td><td>${books.length ? books.join() : '(no books found)'}</td></tr>`;
                    });
                    setTimeout(function() {
                        $('.listBody').html(row);
                        const rows = Array.from($('tr').not(':first'));
                        rows.forEach(slideOut);
                        rows.forEach(slideIn);
                    }, 1000)

                } else {
                    $('#myTable').html('<h4 class="danger">Something Went Wrong..</h4>');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log('error');
            }
        });
    }

    /**
     * Load lists of authors and books on document ready
     */
    $(document).ready(function() {
        listData();
    });

    /**
     * Slide out table rows
     */
    function slideOut(row) {
        row.classList.add('slide-out');
    }

    /**
     * Slide in table rows
     */
    function slideIn(row, index) {
        setTimeout(function() {
            row.classList.remove('slide-out');
        }, (index + 5) * 200);
    }
</script>
