<?php
namespace App\Policies;

use App\Models\ { User, Article };

use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;
    /**
     * Grant all abilities to administrator.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function before(User $user)
    {
        if ($user->role === 'admin') {
            return true;
        }
        return false;
    }
    /**
     * Determine whether the user can delete the article.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Article $article
     * @return mixed
     */
    public function delete(User $user, Article $article)
    {
        return $user->id === $article->user_id;
    }

    /**
     * Determine whether the user can delete the article.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Article $article
     * @return mixed
     */
    public function update(User $user, Article $article)
    {
        return $user->id === $article->user_id;
    }
}
