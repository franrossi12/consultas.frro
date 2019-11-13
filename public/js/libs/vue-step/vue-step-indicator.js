(function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
        typeof define === 'function' && define.amd ? define(factory) :
            (global.StepIndicator = factory());
}(this, (function () { 'use strict';

    /*!
     * nano-assign v1.0.0
     * (c) 2017-present egoist <0x142857@gmail.com>
     * Released under the MIT License.
     */

    var index = function(obj) {
        var arguments$1 = arguments;

        for (var i = 1; i < arguments.length; i++) {
            // eslint-disable-next-line guard-for-in, prefer-rest-params
            for (var p in arguments[i]) { obj[p] = arguments$1[i][p]; }
        }
        return obj
    };

    var nanoAssign_common = index;

    var index$1 = {
        name: 'StepIndicator',
        functional: true,
        props: {
            total: {
                type: Number,
                required: true
            },
            current: {
                type: Number,
                required: true
            },
            currentColor: {
                type: String,
                default: 'rgb(68, 0, 204)'
            },
            defaultColor: {
                type: String,
                default: 'rgb(130, 140, 153)'
            },
            handleClick: {
                type: Function
            }
        },
        render: function render(h, _ref) {
            var props = _ref.props,
                data = _ref.data;
            var steps = [];

            var _loop = function _loop(i) {
                var color = i === props.current ? props.currentColor : props.defaultColor;
                steps.push(h('div', {
                    class: 'step-indicator',
                    style: {
                        color: color,
                        borderColor: color
                    },
                    on: {
                        click: function click() {
                            return props.handleClick && props.handleClick(i);
                        }
                    }
                }, [i + 1]));
            };

            for (var i = 0; i < props.total; i++) {
                _loop(i);
            }

            var attrs = nanoAssign_common({}, data, {
                class: ['step-indicators', data.class]
            });
            return h('div', attrs, [h('span', {
                class: 'step-indicators-line'
            })].concat(steps));
        }
    };

    return index$1;

})));
