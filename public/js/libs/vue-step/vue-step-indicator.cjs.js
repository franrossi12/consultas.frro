'use strict';

function _interopDefault (ex) { return (ex && (typeof ex === 'object') && 'default' in ex) ? ex['default'] : ex; }

var assign = _interopDefault(require('nano-assign'));

var index = {
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

        var attrs = assign({}, data, {
            class: ['step-indicators', data.class]
        });
        return h('div', attrs, [h('span', {
            class: 'step-indicators-line'
        })].concat(steps));
    }
};

module.exports = index;
