import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {Head} from "@inertiajs/react";
import Dropdown from "@/Components/Dropdown";

export default function Teams({auth}){

    const teams = ['Time 1', 'Time 2', 'Time 3']
    return (
        <AuthenticatedLayout
            auth={auth}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Manage Teams</h2>}
        >
        <Head title={"Manage teams"} />
        <div className="flex items-center flex-col px-96">
            {teams.map((team) =>
               <Dropdown.List  key={team} teamName={team}/>
            )}
        </div>

        </AuthenticatedLayout>
    )
}
