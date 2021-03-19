@extends('template.template')

@section('title')
    Markdown Guide
@endsection

@section('content')
    <table class="table">
        <thead>
            <th>What you want</th>
            <th>How to get it</th>
        </thead>
        <tr>
            <td>
                <strong>Bold Text</strong>
            </td>
            <td>
                <pre>**Bold Text**</pre>
            </td>
        </tr>
        <tr>
            <td>
                <em>Italic Text</em>
            </td>
            <td>
                <pre>*Italic Text*</pre>
            </td>
        </tr>
        <tr>
            <td>
                <a href="#">Hyperlink</a>
            </td>
            <td>
                <pre>[Hyperlink](http://example.com)</pre>
            </td>
        </tr>
        <tr>
            <td>
                <ul>
                    <li>
                        Bullet List
                    </li>
                </ul>
            </td>
            <td>
                <pre>* Bullet List</pre>
            </td>
        </tr>
        <tr>
            <td>
                <ol>
                    <li>
                        Numbered list
                    </li>
                </ol>
            </td>
            <td>
                <pre>[Hyperlink](http://example.com)</pre>
            </td>
        </tr>
    </table>

    <p>The above is just a sample of what you can do with Markdown. Follow this link to learn more about
        <a href="https://www.markdownguide.org/basic-syntax/">Markdown syntax</a>.
@stop
