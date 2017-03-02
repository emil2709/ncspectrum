if($request->ajax())
        {
            $output = "";
            $users = DB::table('users')
                ->where('firstname', 'like', '%'.$request->search.'%')
                ->orWhere('lastname', 'like', '%'.$request->search.'%')
                ->get();

            if($users)
            {
                if($request->type === "guest")
                {
                    foreach($users as $user)
                    {
                        if($user->company !== "ncspectrum")
                        {
                            $output.=
                            '<tr>'.
                                '<td>'.$user->firstname.'</td>'.
                                '<td>'.$user->lastname.'</td>'.
                                '<td>'.$user->phone.'</td>'.
                                '<td>'.$user->email.'</td>'.
                                '<td>'.$user->company.'</td>'.
                                '<td>'.
                                    '<a href="/admins/'.$user->id.'/edit">'.
                                    '<span class="glyphicon glyphicon-edit"></span></a>'.
                                '</td>'.
                                '<td>'.
                                    '<a href="/admins/'.$user->id.'">'.
                                    '<span class="glyphicon glyphicon-trash"></span></a>'.
                                '</td>'.
                            '</tr>';
                        }
                    }
                }
                else
                {
                    foreach($users as $user)
                    {
                        if($user->company === "ncspectrum")
                        {
                            $output.=
                            '<tr>'.
                                '<td>'.$user->firstname.'</td>'.
                                '<td>'.$user->lastname.'</td>'.
                                '<td>'.$user->phone.'</td>'.
                                '<td>'.$user->email.'</td>'.
                                '<td>'.$user->company.'</td>'.
                                '<td>'.
                                    '<a href="/admins/'.$user->id.'/edit">'.
                                    '<span class="glyphicon glyphicon-edit"></span></a>'.
                                '</td>'.
                                '<td>'.
                                    '<a href="/admins/'.$user->id.'">'.
                                    '<span class="glyphicon glyphicon-trash"></span></a>'.
                                '</td>'.
                            '</tr>';
                        }
                    }
                }

                if($output=="")
                {
                    $output = "<div class='margin-top' id='notfound'><strong>".$request->search."</strong> Not Found</div>";
                    return Response($output);
                }
                else
                {
                    return Response($output);
                }
            }
        }