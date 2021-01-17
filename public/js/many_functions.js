let deleteElement = (ids, input_name) => {
    document
        .querySelectorAll("input[type=checkbox][name=" + input_name + "]")
        .forEach((item) => {
            if (ids.includes(item.value)) {
                // search row parent
                row = item.parentNode;
                while (row.nodeName != "TR") {
                    row = row.parentNode;
                }
                row.remove();
            }
        });
};

let displayForm = () => {
    if (company_ids.length == 0) {
        document.getElementById("delete-form").classList.add("is-hidden");
    } else {
        document.getElementById("delete-form").classList.remove("is-hidden");
    }
};
