@push('head')
    <style>
        .position-fixed {
            position: fixed;
            left: 10%;
            bottom: 10px;
        }

    </style>
@endpush
<div class="position-fixed is-hidden" id="delete-form">
    <div class="buttons">
        <span class="button is-rounded is-primary" id="item-count">
            0
        </span>
        <button class="button is-danger is-rounded" data-tooltip="Delete Company" id="button-delete">
            <span class="icon">
                <i class="fa fa-trash"></i>
            </span>
        </button>
    </div>
</div>

@push('script')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            let url = "{{ $action_url }}";
            ids = []
            id_name = "{{ $input_name }}"
            deleteElement = (ids) => {
                document.querySelectorAll("input[type=checkbox][name=" + id_name + "]").forEach((item) => {
                    if (ids.includes(item.value)) {
                        // search row parent
                        row = item.parentNode;
                        while (row.nodeName != "TR") {
                            row = row.parentNode;
                        }
                        row.remove();
                    }
                })
            }

            displayForm = (ids) => {
                if (ids.length == 0) {
                    document.getElementById('delete-form').classList.add('is-hidden');
                } else {
                    document.getElementById('delete-form').classList.remove('is-hidden');
                }
            }

            document.querySelectorAll('input[type=checkbox][name=' + id_name + ']').forEach((item) => {
                item.addEventListener('click', () => {
                    if (item.checked) {
                        ids.push(item.value)
                    } else {
                        ids = ids.filter(job => !(item.value == job))
                    }

                    // assign to input hidden job ids
                    document.getElementById('item-count').innerHTML = ids.length
                    displayForm(ids);
                })
            });

            document.getElementById('button-delete').addEventListener('click', () => {
                let data = {
                    '_token': "{{ csrf_token() }}",
                    '_method': "DELETE",
                    'ids': ids
                };

                $.ajax({
                    type: "DELETE",
                    url: url,
                    data: data,
                    // dataType: "dataType",
                    success: function(response) {
                        deleteElement(ids);
                        ids = [];
                        displayForm(ids);
                    }
                });
            })

        })

    </script>
@endpush
