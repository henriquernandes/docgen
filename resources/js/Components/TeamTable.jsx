import {BsPencil, CgTrash} from "react-icons/all";

export default function TeamTable({users}){

    return (
        <>
            <table className="w-full">
                <tbody>
                    <tr className="w-full">
                    {users.map((user, i) => (
                        <td className="inline-flex">
                            {user}
                            <CgTrash className="mx-1"/>
                            <BsPencil/>
                        </td>
                    ))}
                    </tr>
                </tbody>
            </table>
        </>
    )
}
