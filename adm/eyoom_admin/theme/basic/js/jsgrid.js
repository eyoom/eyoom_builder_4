!function (document, window, $) {
    "use strict";
    jsGrid.setDefaults("text", {
        _createTextBox: function () {
            return $("<input>")
                .attr("type", "text")
                .attr("class", "form-control input-sm")
        }
    }),
    jsGrid.setDefaults("number", {
        _createTextBox: function () {
            return $("<input>")
                .attr("type", "number")
                .attr("class", "form-control input-sm")
        }
    }),
    jsGrid.setDefaults("textarea", {
        _createTextBox: function () {
            return $("<input>")
                .attr("type", "textarea")
                .attr("class", "form-control")
        }
    }),
    jsGrid.setDefaults("control", {
        _createGridButton: function (cls, tooltip, clickHandler) {
            var grid = this._grid;
            return $("<button>")
                .addClass(this.buttonClass)
                .addClass(cls)
                .attr({title: tooltip, type: "button"})
                .on("click", function (e) {
                    clickHandler(grid, e)
                })
        }
    }),
    jsGrid.setDefaults("select", {
        _createSelect: function () {
            var $result       = $("<select>").attr("class", "form-control input-sm"),
                valueField    = this.valueField,
                textField     = this.textField,
                selectedIndex = this.selectedIndex;
            return $.each(this.items, function (index, item) {
                var value   = valueField
                        ? item[valueField]
                        : index,
                    text    = textField
                        ? item[textField]
                        : item,
                    $option = $("<option>")
                        .attr("value", value)
                        .text(text)
                        .appendTo($result);
                $option.prop("selected", selectedIndex === index)
            }),
            $result
        }
    })
}(document, window, jQuery);