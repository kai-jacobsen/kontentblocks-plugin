``length``
==========

The ``length`` filter returns the number of items of a sequence or mapping, or
the length of a string:

For objects that implement the ``IteratorAggregate`` interface, ``length`` will use the return value of the ``iterator_count()`` method.

.. code-block:: jinja

    {% if users|length > 10 %}
        ...
    {% endif %}
