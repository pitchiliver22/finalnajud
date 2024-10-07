@include('templates.studentheader')

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>Student Grades</h1>
        </div>
    </div>
    <h2>Grades S.Y 2024-2025</h2>
    <table class="table-primary">
        <tr>
            <th>Subject</th>
            <th>1st quarter</th>
            <th>2nd quarter</th>
            <th>3rd quarter</th>
            <th>4th quarter</th>
            <th>Final Grade</th>
        </tr>
        <tr>
            <td>Biology</td>
            <td>85</td>
            <td>89</td>
            <td>98</td>
            <td>78</td>
            <td>82.5</td>
        </tr>
        <tr>
            <td>Chemistry</td>
            <td>79</td>
            <td>89</td>
            <td>85</td>
            <td>89</td>
            <td>85.5</td>

        </tr>
        <tr>
            <td>Science</td>
            <td>92</td>
            <td>85</td>
            <td>79</td>
            <td>89</td>
            <td>86.25</td>
        </tr>
        <tr>
            <td>Social Studies</td>
            <td>88</td>
            <td>89</td>
            <td>98</td>
            <td>78</td>
            <td>88.25</td>
        </tr>
        <tr>
            <td>Art</td>
            <td>90</td>
            <td>85</td>
            <td>86</td>
            <td>82</td>
            <td>85.75</td>
        </tr>
        <tr>
            <td>English</td>
            <td>87</td>
            <td>94</td>
            <td>81</td>
            <td>78</td>
            <td>85</td>
        </tr>
        <tr>
            <td>Mathematics</td>
            <td>95</td>
            <td>95</td>
            <td>85</td>
            <td>75</td>
            <td>87.5</td>
        </tr>

        <tr>
            <td>Physics</td>
            <td>95</td>
            <td>95</td>
            <td>85</td>
            <td>75</td>
            <td>87.5</td>
        </tr>
        <tr>
            <td>General Average</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="color: green;">87</td>
        </tr>
    </table>

</div>

<style>
    .table-primary {
        width: 100%;
        border-collapse: collapse;
        background-color: #f2f2f2;
    }

    .table-primary th,
    .table-primary td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .table-primary th {
        background-color: #4CAF50;
        color: white;
    }
</style>
@include('templates.studentfooter')
